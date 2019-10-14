<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Models\User;
use Image;
use Storage;

class UserService
{
	/** 
	 * Set profile image for user
	 * 
	 * @param UploadedFile
	 * @param User
	 * @param string
	 * @return void
	**/ 
	public function setProfileImage(
		UploadedFile $file,
		User $user,
		string $disk = 'public'
	)
	{
		if ($user->profile_image != User::DEFAULT_PROFILE_IMAGE_PATH) {
			$this->removeProfileImage($user->profile_image, $disk);
		}

		$image_name = $this->getImageName($user->name, $file->clientExtension());

		return $this->storeProfileImage($file, $image_name);
	}

	/** 
	 * Remove old user`s profile image 
	 * and set default profile image 
	 *  
	 * @param User
	 * @return bool
	**/ 
	public function setDefaultProfileImage(User $user)
	{
		$this->removeProfileImage($user->profile_image);
		$user->profile_image = User::DEFAULT_PROFILE_IMAGE_PATH;

		return $user->save();
	}

	/*|========| Private functions |=======|*/

	/** 
	 * Store and crop profile image
	 * 
	 * @param UploadedFile 
	 * @param string
	 * @param string
	 * @return string|false
	**/ 
	private function storeProfileImage(
		UploadedFile $file,
		string $name,
		string $disk = 'public'
	)
	{	
		$path = $file->storeAs(User::PROFILE_IMAGES_PATH, $name, $disk);

		if ($path) {
			$image = Image::make(storage_path("app/public/$path"));
			$image->fit(User::PROFILE_IMAGE_WIDTH, User::PROFILE_IMAGE_HEIGHT);
			$image->save();
		}	

		return $path;
	}

	/** 
	 * Remove user`s profile image from disk
	 * 
	 * @param string
	 * @param string
	 * @return bool
	**/ 
	private function removeProfileImage(
		string $image_name,
		string $disk = 'public'
	)
	{
		$disk_storage = Storage::disk($disk);

		if ($disk_storage->exists($image_name)) {
			return $disk_storage->delete($image_name);
		}

		return false;
	}

	/** 
	 * Generate image name by name and time;
	 * 
	 * @param string
	 * @param string
	 * @return string
	**/ 
	private function getImageName(string $name, string $extension)
	{
		return $name . '_' . time() . '.' . $extension;
	}
}


