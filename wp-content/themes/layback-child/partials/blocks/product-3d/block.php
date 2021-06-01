<?php

	add_action('acf/init', 'lb_register_product_3d');
	function lb_register_product_3d()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('Product 3D', 'layback');
	    	$description 			= __('Product 3D block', 'layback');
	    	$tags 					=	array('Product', '3D');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'product_3d_block_render_callback';

	        // register a testimonial block.
	        acf_register_block_type(array(
	            'name'              => basename(__DIR__),
				'title'             => $title,
				'description'       => $description,
				'keywords'			=> $tags,
				'icon'              => '',
				'category'          => 'layback',
//					'post_types' 		=> array('post', 'page'),
				'supports' 			=> array(
					'mode'			=> 'auto',
					'align'			=> $align,
				),
				'render_callback'   => $render,
				'enqueue_style' 	=> get_stylesheet_directory_uri() . '/partials/blocks/' . basename(__DIR__) . '/style.css',
				'enqueue_script' 	=> get_stylesheet_directory_uri() . '/partials/blocks/' . basename(__DIR__) . '/script.js',
	        ));
	    }
	}

	function product_3d_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
	{

		/* Add all variables in the top
		-------------------------------------------------- */

		$block_name			= substr($block['name'], 4);
		$block_id 			= $block['id'];
		$block_title 		= strtolower(str_replace(" ","_",$block['title']));
		$block_filename 	= pathinfo(__FILE__, PATHINFO_FILENAME);
		
		if( !empty($block['align']) ) {
			$block_align 	= $block['align'];
		}

		$product3D 			= get_field('product_3d');

		$controls 			= get_field('controls');
		$autorotate 		= get_field('autorotate');
	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">	
			
			<h2><span class="dots"></span><?php echo 'Lorem ipsum?!'; ?></h2>

			<div id="canvas-parent">
				<canvas class="webgl"></canvas>
			</div>

			<script type="module">	
				// const gui = new dat.GUI();

				// Canvas
				const canvas = document.querySelector('canvas.webgl');

				// Scene
				const scene = new THREE.Scene();

				// Objects
				const geometry = new THREE.TorusGeometry( .4, .1, 8, 50 );

				// Materials
				const material = new THREE.MeshBasicMaterial();
				material.color = new THREE.Color(0xff0000);

				// Mesh
				const sphere = new THREE.Mesh(geometry, material);
				sphere.position.x = 0;
				sphere.position.y = 0;
				// scene.add(sphere);

			    const glTFLoader = new THREE.GLTFLoader();
			    let model;
			    glTFLoader.load('<?php echo $product3D['url']; ?>', (glTF) => {
			    	model = glTF.scene;
			      	scene.add(model);
				}); 

				// Lights
				const pointLight = new THREE.PointLight(0xffffff, 0.7);
				pointLight.position.set(15, 3, 15);
				scene.add(pointLight);

				const pointLight2 = new THREE.PointLight(0xffffff, 0.5);
				pointLight2.position.set(0, 10, -10);
				scene.add(pointLight2);

				// gui.add(pointLight2.position, 'y');

				// Sizes
				const sizes = {
				    width: document.getElementById('canvas-parent').clientWidth,
				    height: document.getElementById('canvas-parent').clientHeight,
				};

				window.addEventListener('resize', () =>
				{
				    // Update sizes
				    sizes.width = document.getElementById('canvas-parent').clientWidth;
				    sizes.height = document.getElementById('canvas-parent').clientHeight;

				    // Update camera
				    camera.aspect = sizes.width / sizes.height;
				    camera.updateProjectionMatrix();

				    // Update renderer
				    renderer.setSize(sizes.width, sizes.height);
				    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
				});

				// Base camera
				const camera = new THREE.PerspectiveCamera(75, sizes.width / sizes.height, 0.1, 100);
				camera.position.x = 0;
				camera.position.y = 0;
				camera.position.z = 8;
				scene.add(camera);

				// Controls
				<?php if($controls) : ?>
					const controls = new THREE.OrbitControls(camera, canvas);
					controls.minDistance = 5;
					controls.maxDistance = 15;
					controls.enableDamping = true;
				<?php endif; ?>

				/**
				 * Renderer
				 */
				const renderer = new THREE.WebGLRenderer({
				    canvas: canvas
				});
				renderer.setSize(sizes.width, 500);
				renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

				// Animate
				document.getElementById('canvas-parent').addEventListener('mousemove', onDocumentMouseMove);

				let mouseX = 0;
				let mouseY = 0;

				let targetX = 0;
				let targetY = 0;

				let windowX = document.getElementById('canvas-parent').clientWidth / 2;
				let windowY = document.getElementById('canvas-parent').clientHeight / 2;

				function onDocumentMouseMove(event) {
					windowX = document.getElementById('canvas-parent').clientWidth / 2;
					windowY = document.getElementById('canvas-parent').clientHeight / 2;
					mouseX = (event.offsetX - windowX);
					mouseY = (event.offsetY - windowY);
				}

				const clock = new THREE.Clock();

				const tick = () =>
				{
					targetX = mouseX * 0.001;
					targetY = mouseY * 0.001;

				    const elapsedTime = clock.getElapsedTime();

				    // Update objects
				    <?php if($autorotate) : ?>
					    if(model != undefined)
					    {
				    		model.rotation.y += .003;
					    }
					<?php else : ?>
						if(model != undefined)
					    {
				    		model.rotation.y += .5 * (targetX - model.rotation.y);
					    }
					<?php endif; ?>
				    // sphere.position.x = 5 * (targetX);
				    // sphere.position.y = -10 * (targetY);

				    pointLight.position.x = 5 * (targetX);
				    pointLight.position.y = -10 * (targetY);

				    // pointLight2.position.x = 5 * (targetX);
				    // pointLight2.position.y = -5 * (targetX);

				    // Update Orbital Controls
					<?php if($controls) : ?>
					    controls.update();
					<?php endif; ?>

				    // Render
				    renderer.render(scene, camera);

				    // Call tick again on the next frame
				    window.requestAnimationFrame(tick);
				};

				tick();
			</script>	
	    </div>
    <?php }