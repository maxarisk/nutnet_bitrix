document.addEventListener("DOMContentLoaded", function() {
	const form = document.forms['form_feedback'];
	const response = document.querySelector('.form_response');
	if (form && response) {
		form.addEventListener("submit", (event) => {
			event.preventDefault();
			const formData = new FormData(form);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/local/ajax/form_feedback.php',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					//console.log(data);
					if (data.error) {
						response.classList.add('error');
						response.innerHTML = data.error;
					}
					else if (data.success) {
						response.classList.remove('error');
						response.innerHTML = data.success;
						form.reset();
					}
				},
			});
		});
	}
});