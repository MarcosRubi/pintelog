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
function showMenu() {
	const menu = document.querySelector("nav.menu ul");
	const icon = document.querySelector(".menu__icon--hamburguer");

	icon.classList.toggle("close");
	menu.classList.toggle("showMenu");
}
const gallery = [
	{
		routeImg : 'images/profile/1.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/2.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/3.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/4.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/5.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/6.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/7.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/8.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/9.jpg',
		description: 'Publicado por'
	},
	{
		routeImg : 'images/profile/10.jpg',
		description: 'Publicado por'
	}

]
function getGallery(){
	let divGallery = document.getElementById('gallery')
	let content = '' 
	gallery.forEach(element => {
		let template = `
		<div class="gallery__item">
			<img class="gallery__img" src="${element.routeImg}" alt="Foto publicada por DanielR" />
			<div class="gallery__content d-flex jc-between align-center p-absolute">
			<p class="gallery__description"> ${element.description} <a href="profile.html"> DanielR</a></p>
			
				<button type="submit" onclick="window.open('${element.routeImg}')">
					<i class="fa fa-download"></i>
				</button>
			</div>
		</div>
		`
		content += template
	});
	divGallery.innerHTML += content 
}
window.addEventListener("load", () => {
	if (window.location.href.indexOf("iniciar-sesion") != -1) {
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
	if (window.location.href.indexOf("iniciar-sesion") == -1 && window.location.href.indexOf("registro") == -1) {
		//MOSTRAR SUBMENU
		document.getElementById("showSubmenu").addEventListener("click", () => {
			const submenu = document.getElementById("submenu");
			submenu.classList.toggle("show");
		});
		getGallery()
	}
});
