import axios from 'axios';

let likeButtons = document.querySelectorAll('.like-btn');// a + .like-btn

let state_texts = {
	'active': 'You like it',
	'non_active': 'Like'
};

let likeFunc = function (event) {
	event.preventDefault();
	this.setAttribute('aria-disabled', 'true');
	axios.get(this.href).then(response => {
		if (response.data.result == 'Ok') {
			let likesCountElem = this.querySelector('.likes-count');

			if (this.classList.contains('active')) {
				this.classList.remove('active');

				if (likesCountElem.dataset.likesCount == 1) {
					likesCountElem.setAttribute('hidden', '');
				}

				likesCountElem.dataset.likesCount--;

				this.innerHTML = this.innerHTML.replace(
					state_texts['active'],
					state_texts['non_active']
				);
				
				this.href = response.data.next_uri;
			} else {
				this.classList.add('active');

				if (likesCountElem.dataset.likesCount == 0) {
					likesCountElem.removeAttribute('hidden');
				}
				likesCountElem.dataset.likesCount++;

				this.innerHTML = this.innerHTML.replace(
					state_texts['non_active'],
					state_texts['active']
				);

				this.href = response.data.next_uri;
			}
		}
		this.removeAttribute('aria-disabled');
	});
}

Array.from(likeButtons).forEach(item => {
	item.addEventListener('click', likeFunc, false);
});
