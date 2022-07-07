//FUNCIONES DE FORMULARIOS DE INICIO DE SESION Y REGISTRO
//Mostrar contraseña en el input, si es new se muestra la contraseña nueva, por defecto se muestra la contraseña actual
function showPassword(val) {
	if (val == "old") {
		const icon = document.getElementById("toggle-password");
		const input = document.getElementById("txtPassword");
		changeTypeInput(input, icon);
	} else {
		const icon = document.getElementById("toggle-password-new");
		const input = document.getElementById("txtNewPassword");
		changeTypeInput(input, icon);
	}
}
function changeTypeInput(input, icon) {
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
//Comenzar el proceso de restablecer la contraseña
function resetPassword(last = false) {
	const loginForm = document.querySelector(".login-form");
	if (last) {
		showModalPassword(3, true);
		loginForm.classList.remove("hide");
	} else {
		showModalPassword(1);
		loginForm.classList.add("hide");
	}
}
function showModalPassword(step, last = false) {
	const divModal = document.getElementById("modal-step-" + step);

	divModal.classList.add("show");

	if (step - 1 > 0) {
		let stepOld = step - 1;
		const divModalOld = document.getElementById("modal-step-" + stepOld);
		divModalOld.classList.remove("show");
	}
	last ? divModal.classList.remove("show") : "";
}
//cerrar el modal
function hideModalPassword() {
	const loginForm = document.querySelector(".login-form");
	document.querySelector(".show").classList.remove("show");
	loginForm.classList.remove("hide");
}

//FUNCIONES PARA MODAL DE SUBIR PUBLICACION
function showModalUpload() {
	document.querySelector("section.profile")
		? document.querySelector("section.profile").classList.add("hide")
		: "";
	document.querySelector(".upload .modal-center").classList.add("show");
	document.querySelector("header").classList.add("hide");
	document.querySelector("section.gallery").classList.add("hide");
}
function hideModalUpload() {
	document.querySelector("section.profile")
		? document.querySelector("section.profile").classList.remove("hide")
		: "";
	document.querySelector(".upload .modal-center").classList.remove("show");
	document.querySelector("header").classList.remove("hide");
	document.querySelector("section.gallery").classList.remove("hide");
}

function displayFileModal() {
	const dragArea = document.querySelector(".drag-area");
	const displayImg = document.getElementById("displayImg");
	let fileType = file.type;
	let validExtensions = ["image/jpeg", "image/jpg", "image/png"];

	if (validExtensions.includes(fileType)) {
		let reader = new FileReader();
		reader.onload = function () {
			let dataURL = reader.result;
			let image = `<img src="${dataURL}" alt=""/>`;
			displayImg.innerHTML = image;
			displayImg.style.display = "block";
			dragArea.style.display = "none";
		};
		reader.readAsDataURL(file);
	}
}
function resetModalUpload() {
	const dragArea = document.querySelector(".drag-area");
	const dragText = document.querySelector(".header");
	const input = document.querySelector("#filePost");

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

// FUNCIONES DEL MENU
//Mostrar menu en dispositivos moviles
function showMenuHamburguer() {
	document.querySelector(".menu__icon--hamburguer").classList.toggle("close");
	document.querySelector("nav.menu ul").classList.toggle("showMenu");
	document.querySelector("nav.menu").classList.toggle("show");
}
//Mostrar opciones del usuario
function showSubmenu() {
	document.getElementById("submenu")
		? document.getElementById("submenu").classList.toggle("show")
		: "";
}

// FUNCIONES PARA EDITAR PERFIL
//Mostrar div para cambiar contraseña
function toggleChangePassword() {
	document.querySelector("#divPassword").classList.toggle("show");
}
function setPhotoProfile() {
	const span = document.querySelector(".file-label span");
	const input = document.getElementById("fileFoto");
	let name = input.files[0].name.slice(0, 5);
	let format = input.files[0].name.slice(-4);
	span.innerHTML = `${name}&hellip;${format}`;
}

// FUNCIONES GENERALES
//Cambiar titulo de la página
function setTitle(title) {
	document.querySelector("title").textContent = `${title} | Pintelog`;
}
//Agregar publicación a favoritos
function addFavoritePost(index) {
	document.getElementById(`post-${index}`).classList.toggle("favorite");
}

function hideMessage(btn = false) {
	btn
		? document.querySelector("li.message").classList.add("hide")
		: setTimeout(() => {
				document.querySelector("li.message")
					? document.querySelector("li.message").classList.add("hide")
					: "";
		  }, 3000);
}

//Agregar clase active al item activo del menu
function addItemActive(id) {
	const menu = document.querySelectorAll("nav.menu a");
	menu.forEach((element, index) => {
		element.addEventListener("click", () => {
			if (index != 0) {
				document.querySelector("nav.menu a.active")
					? document
							.querySelector("nav.menu a.active")
							.classList.remove("active")
					: "";
				element.classList.add("active");
			}
		});
	});
}

// COMPONENTES
function getComponentHeader() {
	xhr = new XMLHttpRequest();
	xhr.open("GET", "components/HeaderComponent.php", false);
	xhr.send();
	con = document.getElementById("headerContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	addItemActive();
}

function getComponentProfile(id) {
	xhr = new XMLHttpRequest();
	xhr.open("GET", "components/ProfileComponent.php?id=" + id, false);
	xhr.send();
	con = document.getElementById("profileContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	setTitle("Perfil");
}

function getComponentProfileEdit() {
	xhr = new XMLHttpRequest();
	xhr.open("GET", "components/EditProfileComponent.php", false);
	xhr.send();
	con = document.getElementById("profileContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
}

function getComponentGallery(val, id) {
	xhr = new XMLHttpRequest();
	xhr.open(
		"GET",
		"components/GalleryComponent.php?val=" + val + "&id=" + id,
		false
	);
	xhr.send();
	con = document.getElementById("mainContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
}

function getComponentModalUpload() {
	xhr = new XMLHttpRequest();
	xhr.open("GET", "components/ModalCreatePostComponent.php", false);
	xhr.send();
	con = document.getElementById("modalUploadContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	resetModalUpload();
}

function getComponentFooter() {
	xhr = new XMLHttpRequest();
	xhr.open("GET", "components/FooterComponent.php", false);
	xhr.send();
	con = document.getElementById("footerContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
}

// VISTAS

function getViewLogin() {
	setTitle("Iniciar Sesion");

	xhr = new XMLHttpRequest();
	xhr.open("GET", "components/LoginComponent.php", false);
	xhr.send();
	con = document.getElementById("mainContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	document.getElementById("headerContainer").innerHTML = "";
	document.getElementById("profileContainer").innerHTML = "";
	document.getElementById("modalUploadContainer").innerHTML = "";
	document.getElementById("footerContainer").innerHTML = "";
}

function getViewRegister() {
	setTitle("Registrarse");

	xhr = new XMLHttpRequest();
	xhr.open("GET", "components/RegisterComponent.php", false);
	xhr.send();
	con = document.getElementById("mainContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	document.getElementById("headerContainer").innerHTML = "";
	document.getElementById("profileContainer").innerHTML = "";
	document.getElementById("modalUploadContainer").innerHTML = "";
	document.getElementById("footerContainer").innerHTML = "";
}

function getViewHome() {
	setTitle("Inicio");

	getComponentHeader();
	getComponentGallery("home");
	getComponentModalUpload();
	getComponentFooter();

	document.getElementById("profileContainer").innerHTML = "";
}

function getViewProfile(id) {
	setTitle("Perfil");

	getComponentProfile(id);
	getComponentGallery("publicaciones", id);
}

function getViewProfileEdit() {
	setTitle("Editar Perfil");

	getComponentProfileEdit();
	getComponentGallery("publicaciones");
}

function getViewFavorites() {
	setTitle("Favoritos");

	getComponentProfile();
	getComponentGallery("favoritos");
}

//FUNCIONES
function getCloseSession() {
	xhr = new XMLHttpRequest();
	xhr.open("GET", "func/sessionDestroy.php", false);
	xhr.send();
	getViewLogin();
}

function CreateUser() {
	let fd = new FormData(document.forms["frmRegister"]);
	xhr = new XMLHttpRequest();
	xhr.open("POST", "func/validateNewUser.php", false);
	xhr.send(fd);
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}

function ValidLogin() {
	let fd = new FormData(document.forms["frmLogin"]);
	xhr = new XMLHttpRequest();
	xhr.open("POST", "func/validateLogin.php", false);
	xhr.send(fd);
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}

function verifyEmail() {
	let fd = new FormData(document.forms["frmVerifyEmail"]);
	xhr = new XMLHttpRequest();
	xhr.open("POST", "func/verifyEmail.php", false);
	xhr.send(fd);
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}
function codeVerify() {
	let fd = new FormData(document.forms["frmCodeVerify"]);
	xhr = new XMLHttpRequest();
	xhr.open("POST", "func/verifyCode.php", false);
	xhr.send(fd);
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}
function resendCode() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "func/resendCode.php", false);
	xhr.send();
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}
function changePassword() {
	let fd = new FormData(document.forms["frmNewPassword"]);
	xhr = new XMLHttpRequest();
	xhr.open("POST", "func/resetPassword.php", false);
	xhr.send(fd);
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}

function EditUser() {
	let fd = new FormData(document.forms["frmEditProfile"]);
	xhr = new XMLHttpRequest();
	xhr.open("POST", "func/validateEditUser.php", false);
	xhr.send(fd);
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}

function createPost() {
	let fd = new FormData(document.forms["frmCreatePost"]);
	xhr = new XMLHttpRequest();
	xhr.open("POST", "func/validateNewPost.php", false);
	xhr.send(fd);
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}

function toggleFavorite(idPost) {
	xhr = new XMLHttpRequest();
	xhr.open("GET", "func/toggleFavoritePost.php?idPost=" + idPost, false);
	xhr.send();
	con = document.getElementById("messageContainer");
	res = xhr.responseText;
	con.innerHTML = res.ConvertirResponseText();
	hideMessage();
}

function deletePost(idPost) {
	if (window.confirm("Seguro que desea eliminar la publicación?")) {
		xhr = new XMLHttpRequest();
		xhr.open("GET", "func/deletePost.php?idPost=" + idPost, false);
		xhr.send();
		con = document.getElementById("messageContainer");
		res = xhr.responseText;
		con.innerHTML = res.ConvertirResponseText();
		hideMessage();
	}
}
