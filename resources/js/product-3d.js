import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

console.log("3D Product script loaded");

function init3D() {
    console.log("Initializing 3D...");
    const container = document.getElementById('product-3d-container');
    if (!container) {
        console.error("3D Container not found!");
        return;
    }

    try {
        console.log("Container dimensions:", container.clientWidth, "x", container.clientHeight);

        const width = container.clientWidth || 400;
        const height = container.clientHeight || 400;

        // Scene
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0xffffff);

        // Camera
        const camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
        camera.position.z = 5;

        // Renderer
        const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        renderer.setSize(width, height);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);

        // Lighting
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        scene.add(ambientLight);

        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(5, 5, 5);
        scene.add(directionalLight);

        // Paper Roll / Product Bale Model
        const geometry = new THREE.CylinderGeometry(1.2, 1.2, 2.5, 32);
        const material = new THREE.MeshPhongMaterial({
            color: 0x2d5a27, // Forest Green like the theme
            flatShading: false,
            shininess: 50
        });
        const mesh = new THREE.Mesh(geometry, material);
        scene.add(mesh);

        // Decorative details (lines to look like paper layers)
        const wireframeGeometry = new THREE.EdgesGeometry(geometry);
        const wireframeMaterial = new THREE.LineBasicMaterial({ color: 0xffffff, opacity: 0.3, transparent: true });
        const wireframe = new THREE.LineSegments(wireframeGeometry, wireframeMaterial);
        mesh.add(wireframe);

        // Controls
        const controls = new OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.autoRotate = true;
        controls.autoRotateSpeed = 2;

        // Responsive
        window.addEventListener('resize', () => {
            const newWidth = container.clientWidth;
            const newHeight = container.clientHeight;
            camera.aspect = newWidth / newHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(newWidth, newHeight);
        });

        // Animation
        function animate() {
            requestAnimationFrame(animate);
            controls.update();
            renderer.render(scene, camera);
        }
        animate();
        console.log("3D Rendering started successfully");

    } catch (error) {
        console.error("Failed to initialize 3D scene:", error);
    }
}

// Ensure execution
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init3D);
} else {
    init3D();
}
