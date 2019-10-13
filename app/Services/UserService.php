<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Models\User;
use Image;

class UserService
{
	/** 
	 * Store and crop profile image
	 * 
	 * @param UploadedFile 
	 * @param string
	 * @param string
	 * @return string|false
	**/ 
	public function storeProfileImage(
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
}
