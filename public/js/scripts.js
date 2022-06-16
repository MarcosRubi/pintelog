function showPassword(val) {
	if (val == "old") {
		const icon = document.getElementById("toggle-password");
		const input = document.getElementById("txtPassword");
		typeInput(input, icon);
	} else {
		const icon = document.getElementById("toggle-password-modal");
		const input = document.getElementById("txtNewPassword");
		typeInput(input, icon);
	}
}
function typeInput(input, icon) {
	if (icon.classList.contains("fa-eye-slash")) {
		icon.classList.remove("fa-eye-slash");
		icon.classList.add("fa-eye");
		input.type = "password";
	} else {
		icon.classList.remove("fa-eye");
		icon.classList.add("fa-eye-slash");
		input.type = "text";
	}
}
function showModal(step, last = false) {
	const divModal = document.getElementById("modal-step-" + step);

	divModal.classList.add("show");

	if (step - 1 > 0) {
		let stepOld = step - 1;
		const divModalOld = document.getElementById("modal-step-" + stepOld);
		divModalOld.classList.remove("show");
	}
	last ? divModal.classList.remove("show") : "";
}
function showMenu(){
	const menu = document.querySelector('nav.menu ul')
	const icon = document.querySelector('.menu__icon--hamburguer')
	
	icon.classList.toggle('close')
	menu.classList.toggle('showMenu')
}
window.addEventListener("load", () => {
	if (window.location.href.indexOf("iniciar-sesion") > -1) {
		const loginForm = document.querySelector(".login-form");
		//MOSTAR MODAL
		document.getElementById("reset-password").onclick = function () {
			showModal(1);
			loginForm.classList.add("hide");
		};
		document.getElementById("step-1").addEventListener("submit", () => {
			showModal(2);
		});
		document.getElementById("step-2").addEventListener("submit", () => {
			showModal(3);
		});
		document.getElementById("step-3").addEventListener("submit", () => {
			showModal(3, true);
			loginForm.classList.remove("hide");
		});

		//BOTON CERRAR MODAL
		const btnClose = document.querySelectorAll(".close");
		btnClose.forEach((element) => {
			element.addEventListener("click", () => {
				document.querySelector(".show").classList.remove("show");
				loginForm.classList.remove("hide");
			});
		});
	}
	
		//MOSTRAR SUBMENU
		document.getElementById('showSubmenu').addEventListener('click', ()=>{
			const submenu = document.getElementById('submenu')
			submenu.classList.toggle('show')
		})

});
