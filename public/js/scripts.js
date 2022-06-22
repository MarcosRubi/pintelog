const gallery = [
	{
		routeImg: "images/profile/1.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/2.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/3.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/4.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/5.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/6.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/7.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/8.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/9.jpg",
		description: "Publicado por",
	},
	{
		routeImg: "images/profile/10.jpg",
		description: "Publicado por",
	},
];

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
function showModalUpload(){
	const divModal = document.querySelector('.upload .modal-center')
	const header = document.querySelector('header')
	const sectionGallery = document.querySelector('section.gallery')
	
	if (window.location.href.indexOf("perfil") != -1 ){
		const sectionProfile = document.querySelector('section.profile')
		sectionProfile.classList.add('hide')
	}

	divModal.classList.add('show')
	header.classList.add('hide')
	sectionGallery.classList.add('hide')

}
function closeModalUpload(){
	const divModal = document.querySelector('.upload .modal-center')
	const header = document.querySelector('header')
	const sectionGallery = document.querySelector('section.gallery')

	if (window.location.href.indexOf("perfil") != -1){
		const sectionProfile = document.querySelector('section.profile')
		sectionProfile.classList.remove('hide')
	}
	
	divModal.classList.remove('show')
	header.classList.remove('hide')
	sectionGallery.classList.remove('hide')
}
function showMenu() {
	const menu = document.querySelector("nav.menu ul");
	const divMenu = document.querySelector("nav.menu");
	const icon = document.querySelector(".menu__icon--hamburguer");

	icon.classList.toggle("close");
	menu.classList.toggle("showMenu");
	divMenu.classList.toggle("show");
}
function EditPassword() {
	const divPassword = document.querySelector("#divPassword");
	divPassword.classList.toggle("show");
}
function addFavoritePost(index) {
	let btnPost = document.getElementById(`post-${index}`);
	btnPost.classList.toggle("favorite");
}
function getGallery() {
	let divGallery = document.getElementById("gallery");
	let content = "";
	gallery.forEach((element, index) => {
		let template = `
		<div class="gallery__item">
			<img class="gallery__img" src="${element.routeImg}" alt="Foto publicada por DanielR" />
			<div class="gallery__content d-flex jc-between align-center p-absolute">
			<p class="gallery__description"> ${element.description} <a href="perfil.html"> DanielR</a></p>
			
				<button type="submit" class="btn btn-secondary" onclick="addFavoritePost(${index});" id="post-${index}">
					<i class="fa fa-heart"></i>
				</button>
				<button type="submit" class="btn btn-primary" onclick="window.open('${element.routeImg}')">
					<i class="fa fa-download"></i>
				</button>
			</div>
		</div>
		`;
		content += template;
	});
	divGallery.innerHTML += content;
}
function displayFileModal() {
	const dragArea = document.querySelector(".drag-area");
	let fileType = file.type;
	let validExtensions = ["image/jpeg", "image/jpg", "image/png"];

	if (validExtensions.includes(fileType)) {
		let reader = new FileReader();
		reader.onload = function () {
			let dataURL = reader.result;
			let image = `<img src="${dataURL}" alt=""/>`;
			dragArea.innerHTML = image;
		};
		reader.readAsDataURL(file);
	} else {
		alert("Formato de archivo no valido!");
		dragArea.classList.remove("active");
	}
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
	if (
		window.location.href.indexOf("iniciar-sesion") == -1 &&
		window.location.href.indexOf("registro") == -1
	) {
		//MOSTRAR SUBMENU
		document.getElementById("showSubmenu").addEventListener("click", () => {
			const submenu = document.getElementById("submenu");
			submenu.classList.toggle("show");
		});
		getGallery();

		//MODAL DE SUBIR FOTO
		const dragArea = document.querySelector(".drag-area");
		const dragText = document.querySelector(".header");
		const input = document.querySelector("#file");

		input.addEventListener("change", () => {
			file = input.files[0];
			dragArea.classList.add("active");
			displayFileModal();
		});

		dragArea.addEventListener("dragover", (e) => {
			e.preventDefault();
			dragText.textContent = "Suelte para subir";
			dragArea.classList.add("active");
		});
		dragArea.addEventListener("dragleave", (e) => {
			e.preventDefault();
			dragText.textContent = "Arrastra y suelta";
			dragArea.classList.remove("active");
		});
		dragArea.addEventListener("drop", (e) => {
			e.preventDefault();

			file = e.dataTransfer.files[0];

			displayFileModal();
		});
	}
	if (window.location.href.indexOf("editar-perfil") != -1) {
		//MOSTRAR FOTO SELECCIONADA
		const span = document.querySelector(".file-label span");
		const input = document.getElementById("file");
		input.addEventListener("change", () => {
			let name = input.files[0].name.slice(0, 5);
			let format = input.files[0].name.slice(-4);
			span.innerHTML = `${name}&hellip;${format}`;
		});
	}
});
