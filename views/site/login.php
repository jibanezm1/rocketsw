<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Paciente */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="container">
	<div class="row">
		<div class="col-sm-6 ">
			<img style="    width: 48%;
    display: block;
    text-align: center;
    margin: 0px auto; padding-bottom:50px; padding-top:20px;" src="https://apolotec.cl/images/d-code-logo-light.png" />

			<?php $form = ActiveForm::begin(); ?>
			<div class="form-group">
				<?= $form->field($model, 'correo', ['template' => "{label}{input}"])->textInput(array('class' => 'form-control simple-form-control', 'required' => true))->label("Ingrese su Correo");  ?>
			

				

			</div>
			<div class="form-group">
				<?= $form->field($model, 'clave', ['template' => "{label}{input}"])->textInput(array('class' => 'form-control simple-form-control', 'required' => true, 'type' => 'password'))->label("Contraseña");  ?>
			</div>

			<div style="text-align: center;" class="form-group">
				<button class="button-upload" routerLink="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="36.089" height="34.388" class="button-upload__logo" viewBox="0 0 36.089 34.388">
						<g transform="translate(22.577) rotate(49)" class="button-upload__logo--complete">
							<g transform="translate(5.976 28.664)" class="button-upload__logo--trails">
								<path d="M153.97,738.46l1.692.055v6.115l-1.692-1.147" transform="translate(-153.97 -738.46)" fill="#fafafa" />
								<path d="M337.1,738.46l-1.692.055v6.115l1.692-1.147" transform="translate(-328.367 -738.46)" fill="#fafafa" />
								<path d="M243.98,738.46h1.692V747l-.846.939-.846-.971" transform="translate(-240.486 -738.46)" fill="#fafafa" />
							</g>
							<g class="button-upload__logo--rocket">
								<path d="M19.627,21.9l-2.95-2.95A28.11,28.11,0,0,0,10.3,0,28.1,28.1,0,0,0,3.923,18.952L.973,21.9s-1.454,4.092-.8,6.822l4.393-4.378q.074.358.155.721H5.7l.981.979h3.606l.017-.979.017.979h3.605l.979-.979h.979q.083-.363.155-.721l4.393,4.378C21.082,25.994,19.627,21.9,19.627,21.9Zm-9.3-2.65a2.7,2.7,0,1,1,2.7-2.7A2.7,2.7,0,0,1,10.323,19.252Z" transform="translate(-0.002 0)" fill="#fafafa" />
							</g>
						</g>
					</svg>
					<span class="button-upload__text">Ingresar</span>
				</button>

			</div>
			<?php ActiveForm::end(); ?>

		</div>
		<div class="col-sm-6 ">

			<div id="js-rocket">
				<svg width="477px" height="549px" viewBox="0 0 477 549" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<!-- Generator: Sketch 52.3 (67297) - http://www.bohemiancoding.com/sketch -->

					<defs>
						<linearGradient x1="0%" y1="50%" x2="100%" y2="50%" id="linearGradient-1">
							<stop stop-color="#0CB2E2" offset="0%"></stop>
							<stop stop-color="#4FC0B0" offset="100%"></stop>
						</linearGradient>
						<linearGradient x1="50%" y1="0%" x2="50%" y2="99.6929191%" id="linearGradient-2">
							<stop stop-color="#11B3DE" offset="0%"></stop>
							<stop stop-color="#D8D8D8" stop-opacity="0" offset="100%"></stop>
						</linearGradient>
						<linearGradient x1="100%" y1="100%" x2="100%" y2="0%" id="linearGradient-3">
							<stop stop-color="#0CB2E2" offset="0%"></stop>
							<stop stop-color="#4FC0B0" offset="100%"></stop>
						</linearGradient>
					</defs>
					<g id="Landing-Page" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<g id="Landing" transform="translate(-1022.000000, -1486.000000)">
							<g id="Rocket-Illustration" transform="translate(1022.000000, 1486.000000)">
								<g id="rocket-01" transform="translate(171.000000, 0.000000)">
									<path d="M79.7266842,0 C21.0677259,70.8293925 7.03751832,168.40158 48.352602,259.447674 L108.633142,259.447674 C147.480601,163.648882 135.706507,59.8343441 79.7266842,0 Z" id="Path" stroke="#E2E2E2" fill="#F3F3F3"></path>
									<ellipse id="Oval" fill="url(#linearGradient-1)" cx="77.1789474" cy="92.248062" rx="24.6315789" ry="24.7093023"></ellipse>
									<path d="M127.785996,191.908915 C124.395386,211.396638 119.874571,230.102007 113.305263,247.776091 C131.282564,255.919683 141.419077,273.913822 153.674722,314.631783 C159.290421,247.74053 156.21768,218.082207 127.785996,191.908915 Z" id="Path" fill="url(#linearGradient-1)"></path>
									<path d="M27.3587209,191.908915 C30.3837149,211.224427 35.6950415,229.899646 42.6947368,247.756713 C24.7909935,255.902665 14.6959555,273.902019 2.49045665,314.631783 C-3.1374391,247.685569 -0.956629496,218.054221 27.3587209,191.908915 Z" id="Path" fill="url(#linearGradient-1)"></path>
									<path d="M51.7263158,259.447674 L104.273684,259.447674 L101.04374,267.871788 C85.8664765,271.908343 71.0365186,272.118946 56.5885971,267.871788 L51.7263158,259.447674 Z" id="Path" fill="#444444"></path>
									<path d="M74.6128466,191.933831 C69.9017068,234.60055 70.9643699,275.594761 78.7218105,314.631783 C84.2476586,271.609212 85.8062311,230.40149 82.0514882,191.684735 C80.7054483,182.041131 76.8444391,182.076716 74.6128466,191.933831 Z" id="Path" fill="url(#linearGradient-1)"></path>
									<path d="M59.194048,272.827586 C73.8345836,275.255963 87.4861812,275.371971 100,272.827586 L95,439.039005 L64.194048,439.039005 L59.194048,272.827586 Z" id="flame" fill="url(#linearGradient-2)"></path>
								</g>
								<g id="particles" transform="translate(0.000000, 168.000000)" fill="url(#linearGradient-1)">
									<ellipse id="Oval" cx="89.6431034" cy="50.2915361" rx="5.75689655" ry="5.77115987"></ellipse>
									<ellipse id="Oval-Copy" cx="78.1293103" cy="103.056426" rx="5.75689655" ry="5.77115987"></ellipse>
									<ellipse id="Oval-Copy-10" cx="4.93448276" cy="187.974922" rx="4.93448276" ry="4.94670846"></ellipse>
									<ellipse id="Oval-Copy-11" cx="358.572414" cy="152.523511" rx="4.93448276" ry="4.94670846"></ellipse>
									<ellipse id="Oval-Copy-14" cx="159.548276" cy="207.761755" rx="4.93448276" ry="4.94670846"></ellipse>
									<ellipse id="Oval-Copy-12" cx="342.946552" cy="4.94670846" rx="4.93448276" ry="4.94670846"></ellipse>
									<ellipse id="Oval-Copy-13" cx="419.431034" cy="144.278997" rx="4.93448276" ry="4.94670846"></ellipse>
									<ellipse id="Oval-Copy-5" cx="86.7646552" cy="138.920063" rx="2.87844828" ry="2.88557994"></ellipse>
									<ellipse id="Oval-Copy-9" cx="121.306034" cy="223.014107" rx="2.87844828" ry="2.88557994"></ellipse>
									<ellipse id="Oval-Copy-6" cx="134.464655" cy="85.330721" rx="2.87844828" ry="2.88557994"></ellipse>
									<ellipse id="Oval-Copy-7" cx="383.656034" cy="191.684953" rx="2.87844828" ry="2.88557994"></ellipse>
									<ellipse id="Oval-Copy-8" cx="474.121552" cy="260.11442" rx="2.87844828" ry="2.88557994"></ellipse>
									<ellipse id="Oval-Copy-2" cx="467.953448" cy="84.9184953" rx="5.75689655" ry="5.77115987"></ellipse>
									<ellipse id="Oval-Copy-4" cx="467.953448" cy="183.028213" rx="5.75689655" ry="5.77115987"></ellipse>
									<ellipse id="Oval-Copy-3" cx="386.534483" cy="56.0626959" rx="5.75689655" ry="5.77115987"></ellipse>
								</g>
								<g id="speed" transform="translate(137.000000, 31.000000)" fill="url(#linearGradient-3)">
									<rect id="Rectangle" opacity="0.65" x="0" y="-395" width="7" height="252" rx="3.5"></rect>
									<rect id="Rectangle-Copy-4" opacity="0.148277" x="233" y="-395" width="7" height="362" rx="3.5"></rect>
									<rect id="Rectangle-Copy-3" opacity="0.6" x="168" y="-395" width="7" height="362" rx="3.5"></rect>
									<rect id="Rectangle-Copy-5" opacity="0.6" x="18" y="-395" width="7" height="362" rx="3.5"></rect>
									<rect id="Rectangle-Copy-6" opacity="0.4" x="150" y="-395" width="7" height="362" rx="3.5"></rect>
								</g>
							</g>
						</g>
					</g>
				</svg>
			</div>


		</div>

	</div>
</div>
<style>
	@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap");





	.button-upload {
		font-family: "Montserrat";
		background-color: #40aef600;
		/* box-shadow: 0px 0px 2px #3cbcbe; */
		border-radius: 4%;
		display: flex;
		margin: 0px auto;
		justify-content: center;
		align-items: center;
		width: 100%;
		color: #fafafa;
		flex-direction: column;
		border: none;
		padding: -0.3999999999999999rem;
		transition: all 0.5s cubic-bezier(0.68, 0.15, 0.31, 1.05);
	}

	.button-upload:hover {
		cursor: pointer;
		background-color: #3a3a3a00;
	}

	.button-upload:hover .button-upload__logo--complete {
		animation: rocketAnimation 2s cubic-bezier(0.68, 0.15, 0.31, 1.05) forwards;
	}

	.button-upload__logo {
		width: 4.2rem;
	}

	.button-upload__text {
		font-size: 18px;
		font-weight: 800;
		display: block;
		margin-top: 0.8rem;
	}

	@keyframes rocketAnimation {
		0% {
			transform: rotate(49deg 18px 17px);
		}

		25% {
			transform: rotate(0deg) translateX(6px);
		}

		50% {
			transform: translateY(-45px) translateX(6px);
		}

		60% {
			transform: translateY(30px) translateX(6px);
		}

		70% {
			opacity: 0;
		}

		90% {
			transform: translateY(0px) translateX(6px);
			opacity: 1;
		}

		100% {
			transform: rotate(49deg 18px 17px);
		}
	}
</style>
<style>
	* {
		box-sizing: border-box;
	}




	@-webkit-keyframes caret-color {
		100% {
			caret-color: #E46071;
		}
	}

	@keyframes caret-color {
		100% {
			caret-color: #E46071;
		}
	}

	@-webkit-keyframes caret {
		0% {
			transform: translateY(-24px) scaleY(0);
		}

		50% {
			transform: none;
		}

		100% {
			transform: scaleX(0.2);
		}
	}

	@keyframes caret {
		0% {
			transform: translateY(-24px) scaleY(0);
		}

		50% {
			transform: none;
		}

		100% {
			transform: scaleX(0.2);
		}
	}

	.FancyInput {
		height: 72px;
		margin: 0 auto;
		position: relative;
		width: 276px;
	}

	.FancyInput-input {
		background: none;
		border: none;
		caret-color: transparent;
		color: #E46071;
		display: block;
		font-family: Verdana, Geneva, sans-serif;
		font-size: 20px;
		font-weight: bold;
		height: 100%;
		letter-spacing: 1px;
		outline: 0;
		padding: 15px 30px;
		position: relative;
		text-align: center;
		text-transform: uppercase;
		width: 100%;
		z-index: 10;
	}

	.FancyInput-line {
		display: block;
		height: 72px;
		overflow: hidden;
		position: absolute;
		top: 0;
		width: 138px;
	}

	.FancyInput-line path {
		stroke-dasharray: 314 314;
		stroke-dashoffset: 1;
		transition: all 500ms;
	}

	.FancyInput-line--left {
		left: 0;
		transform: rotateX(0) rotateY(180deg);
	}

	.FancyInput-line--right {
		right: 0;
		transform: rotateX(0) rotateY(0);
	}

	.FancyInput-caret {
		background: #E46071;
		border-radius: 100px;
		height: 24px;
		left: 50%;
		margin-left: -2px;
		position: absolute;
		top: 24px;
		transform-origin: top center;
		transform: translateY(-24px) scaleY(0);
		width: 5px;
	}

	.FancyInput-placeholder {
		font-size: 20px;
		font-weight: bold;
		letter-spacing: 1px;
		color: #E46071;
		width: 200px;
		line-height: 30px;
		left: 50%;
		top: 50%;
		margin: -15px 0 0 -100px;
		position: absolute;
		text-align: center;
		transition: all 500ms;
	}

	.FancyInput-input:focus {
		-webkit-animation: caret-color 300ms;
		animation: caret-color 300ms;
		-webkit-animation-delay: 1000ms;
		animation-delay: 1000ms;
		-webkit-animation-fill-mode: forwards;
		animation-fill-mode: forwards;
	}

	.FancyInput-input:focus+svg path,
	.FancyInput-input:focus+svg+svg path {
		stroke-dasharray: 0 314;
	}

	.FancyInput-input:focus+svg+svg+.FancyInput-caret {
		-webkit-animation: caret 500ms;
		animation: caret 500ms;
		-webkit-animation-delay: 500ms;
		animation-delay: 500ms;
	}

	.FancyInput-input:focus+svg+svg+div+.FancyInput-placeholder {
		opacity: 0;
		transform: scale(0);
	}

	.Info {
		text-align: left;
		color: rgba(255, 255, 255, 0.3);
		font-size: 14px;
		line-height: 22px;
		max-width: 380px;
		margin: 60px auto 0;
	}

	.Info a {
		color: rgba(255, 255, 255, 0.3);
		text-decoration: none;
		border-bottom: thin solid rgba(255, 255, 255, 0.3);
	}

	.Info a:hover {
		color: rgba(255, 255, 255, 0.5);
		border-bottom-color: rgba(255, 255, 255, 0.5);
	}
</style>
<script>
	// All animations are done in CSS
	// JS is only used to hide placeholder div 
	// if there is value in the input

	const input = document.querySelector('.FancyInput-input');
	const placeholder = document.querySelector('.FancyInput-placeholder');


	input.addEventListener('blur', () => {
		if (input.value.trim().length > 0) {
			placeholder.style.display = 'none';
		} else {
			placeholder.style.display = null;
		}
	});
</script>