import axios from 'axios';

let subscribeButtons = document.querySelectorAll('.subscribe-btn')

let state_texts = {
	'active': 'Subscribe',
	'non_active': 'Unsubscribe'
};

let subscribeFunc = function (event) {
	event.preventDefault();
	this.setAttribute('aria-disabled', 'true');

	axios.get(this.href).then(response => {
		if (response.data.result == 'Ok') {
			let subsCountElem = this.querySelector('.subscribers-count');
			if (this.classList.contains('active')) {
				this.classList.remove('active');

				if (subsCountElem.dataset.subscribersCount == 0) {
					subsCountElem.removeAttribute('hidden');
				}

				subsCountElem.dataset.subscribersCount++;

				this.innerHTML = this.innerHTML.replace(
					state_texts['active'],
					state_texts['non_active']
				);
				this.href = response.data.next_uri;

			} else {
				this.classList.add('active');

				if (subsCountElem.dataset.subscribersCount == 1) {
					subsCountElem.setAttribute('hidden', '');
				}

				subsCountElem.dataset.subscribersCount--;

				this.innerHTML = this.innerHTML.replace(
					state_texts['non_active'],
					state_texts['active']
				);
				this.href = response.data.next_uri;
			}
		}
		this.removeAttribute('aria-disabled');
	});
};

Array.from(subscribeButtons).forEach(item => { 
	item.addEventListener('click', subscribeFunc, false);
});