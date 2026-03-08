import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import gsap from 'gsap';

class PulpProcessTour {
    constructor() {
        this.container = document.getElementById('pulp-3d-canvas-container');
        if (!this.container) return;

        this.initScene();
        this.createMaterials();
        this.createModels();
        this.createPipeNetwork();
        this.initControls();
        this.animate();
        this.setupEventListeners();

        this.currentStage = 0;
        this.updateStageUI();
    }

    initScene() {
        this.scene = new THREE.Scene();
        this.scene.background = new THREE.Color(0xf1f5f9);
        this.scene.fog = new THREE.Fog(0xf1f5f9, 200, 700);

        this.camera = new THREE.PerspectiveCamera(45, this.container.clientWidth / this.container.clientHeight, 0.1, 5000);
        this.camera.position.set(250, 150, 450);

        this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true, logarithmicDepthBuffer: true });
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        this.renderer.shadowMap.enabled = true;
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        this.container.appendChild(this.renderer.domElement);

        // Professional Studio Lighting
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        this.scene.add(ambientLight);

        const spotLight = new THREE.SpotLight(0xffffff, 1.5, 0, Math.PI / 4, 0.3);
        spotLight.position.set(300, 600, 300);
        spotLight.castShadow = true;
        spotLight.shadow.mapSize.width = 4096;
        spotLight.shadow.mapSize.height = 4096;
        this.scene.add(spotLight);

        const hemLight = new THREE.HemisphereLight(0xffffff, 0x94a3b8, 0.6);
        this.scene.add(hemLight);

        // Ground Circle
        const ground = new THREE.Mesh(
            new THREE.CircleGeometry(1500, 64),
            new THREE.MeshStandardMaterial({ color: 0xffffff, roughness: 1 })
        );
        ground.rotation.x = -Math.PI / 2;
        ground.position.y = -10;
        ground.receiveShadow = true;
        this.scene.add(ground);
    }

    createMaterials() {
        this.mats = {
            steel: new THREE.MeshStandardMaterial({ color: 0x94a3b8, metalness: 0.8, roughness: 0.2 }),
            blackSteel: new THREE.MeshStandardMaterial({ color: 0x1e293b, metalness: 0.7, roughness: 0.3 }),
            galvanized: new THREE.MeshStandardMaterial({ color: 0xcbd5e1, metalness: 0.5, roughness: 0.5 }),
            techYellow: new THREE.MeshStandardMaterial({ color: 0xeab308, metalness: 0.3, roughness: 0.4 }),
            processGreen: new THREE.MeshStandardMaterial({ color: 0x22c55e, emissive: 0x22c55e, emissiveIntensity: 0.2 }),
            pulp: new THREE.MeshStandardMaterial({ color: 0xffffff, roughness: 1 }),
            wood: new THREE.MeshStandardMaterial({ color: 0x78350f, roughness: 1 }),
            concrete: new THREE.MeshStandardMaterial({ color: 0x64748b, roughness: 0.9 }),
            glass: new THREE.MeshPhysicalMaterial({ color: 0x38bdf8, transparent: true, opacity: 0.3, transmission: 1, roughness: 0 })
        };
    }

    // --- High-Detail Assembly Components ---
    createSupportTruss(height, width) {
        const truss = new THREE.Group();
        const beamRadius = 0.3;
        const mainPillar1 = new THREE.Mesh(new THREE.BoxGeometry(beamRadius * 4, height, beamRadius * 4), this.mats.steel);
        const mainPillar2 = mainPillar1.clone();
        mainPillar1.position.x = -width / 2;
        mainPillar2.position.x = width / 2;
        truss.add(mainPillar1, mainPillar2);

        // Horizontal struts
        const strutCount = Math.floor(height / 4);
        for (let i = 0; i < strutCount; i++) {
            const strut = new THREE.Mesh(new THREE.BoxGeometry(width, beamRadius * 2, beamRadius * 2), this.mats.steel);
            strut.position.y = -height / 2 + (i * 4);
            truss.add(strut);
        }
        return truss;
    }

    createCatwalk(length, width) {
        const catwalk = new THREE.Group();
        const floor = new THREE.Mesh(new THREE.BoxGeometry(length, 0.2, width), this.mats.concrete);
        catwalk.add(floor);
        // Railings
        for (let i = 0; i < 2; i++) {
            const side = i === 0 ? 1 : -1;
            const handrail = new THREE.Mesh(new THREE.CylinderGeometry(0.1, 0.1, length, 8), this.mats.steel);
            handrail.rotation.z = Math.PI / 2;
            handrail.position.set(0, 2.5, (width / 2 - 0.2) * side);
            catwalk.add(handrail);
            // Verticals
            for (let j = 0; j < 5; j++) {
                const vert = new THREE.Mesh(new THREE.CylinderGeometry(0.1, 0.1, 2.5, 8), this.mats.steel);
                vert.position.set(-length / 2 + (j * length / 4), 1.25, (width / 2 - 0.2) * side);
                catwalk.add(vert);
            }
        }
        return catwalk;
    }

    createDetailedMotor() {
        const motor = new THREE.Group();
        const body = new THREE.Mesh(new THREE.CylinderGeometry(1.5, 1.5, 4, 16), this.mats.blackSteel);
        body.rotation.z = Math.PI / 2;
        // Cooling fins
        for (let i = 0; i < 10; i++) {
            const fin = new THREE.Mesh(new THREE.TorusGeometry(1.6, 0.1, 8, 32), this.mats.steel);
            fin.rotation.y = Math.PI / 2;
            fin.position.x = -1.8 + (i * 0.4);
            motor.add(fin);
        }
        const junction = new THREE.Mesh(new THREE.BoxGeometry(1.5, 1.5, 1.5), this.mats.techYellow);
        junction.position.set(0, 1.2, 0);
        motor.add(body, junction);
        return motor;
    }

    createModels() {
        this.stages = [];
        const spacing = 150;

        const addStage = (name, obj, output, input, tech, pos, camOffset) => {
            const group = new THREE.Group();
            group.add(obj);
            group.position.set(pos.x, pos.y, pos.z);
            this.scene.add(group);
            this.stages.push({
                name,
                obj: group,
                input,
                output,
                technical: tech,
                cameraPos: { x: pos.x + camOffset.x, y: pos.y + camOffset.y, z: pos.z + camOffset.z },
                targetPos: { x: pos.x, y: pos.y, z: pos.z }
            });
            return group;
        };

        // --- STAGE 1: DETAILED CHIP HANDLING ASSEMBLY ---
        const chipHandling = new THREE.Group();

        // A. Debarking Drum Assembly
        const debarker = new THREE.Group();
        const mainCyl = new THREE.Mesh(new THREE.CylinderGeometry(10, 10, 45, 64, 1, true), this.mats.galvanized);
        mainCyl.rotation.z = Math.PI / 2;
        debarker.add(mainCyl);
        // Reinforcement Belts
        for (let i = 0; i < 6; i++) {
            const belt = new THREE.Mesh(new THREE.TorusGeometry(10.2, 0.4, 16, 64), this.mats.steel);
            belt.rotation.y = Math.PI / 2;
            belt.position.x = -20 + (i * 8);
            debarker.add(belt);
        }
        // Support Frames (A-Frames)
        for (let i = 0; i < 2; i++) {
            const side = i === 0 ? -15 : 15;
            const frame = this.createSupportTruss(15, 25);
            frame.position.set(side, -10, 0);
            debarker.add(frame);
            const mot = this.createDetailedMotor();
            mot.position.set(side, -12, 12);
            debarker.add(mot);
        }
        debarker.position.x = -20;
        chipHandling.add(debarker);
        this.debarkingDrum = debarker;

        // B. Horizontal Chipper Assembly
        const chipper = new THREE.Group();
        const cBase = new THREE.Mesh(new THREE.BoxGeometry(12, 10, 15), this.mats.techYellow);
        const cInfeed = new THREE.Mesh(new THREE.BoxGeometry(10, 8, 10), this.mats.steel);
        cInfeed.position.set(-10, 1, 0);
        const cOutlet = new THREE.Mesh(new THREE.CylinderGeometry(2, 2, 8, 16), this.mats.steel);
        cOutlet.position.set(4, 8, 0);
        chipper.add(cBase, cInfeed, cOutlet);
        chipper.position.set(40, -2, 0);
        chipHandling.add(chipper);

        // C. Thickness Screener Assembly
        const screener = new THREE.Group();
        const sBody = new THREE.Mesh(new THREE.BoxGeometry(18, 12, 12), this.mats.processGreen);
        const sWalkway = this.createCatwalk(20, 4);
        sWalkway.position.y = 8;
        screener.add(sBody, sWalkway);
        screener.position.set(80, -2, 0);
        chipHandling.add(screener);

        addStage("Phase 1: Chip Handling", chipHandling, "Sized Wood Chips", "Raw Acacia Logs", "Automated Debarking & Precision Chipping", { x: -2 * spacing, y: 0, z: -spacing / 2 }, { x: 40, y: 50, z: 100 });

        // --- STAGE 2: CONTINUOUS DIGESTER TOWER ---
        const cooking = new THREE.Group();
        const towerMain = new THREE.Mesh(new THREE.CylinderGeometry(8, 8.5, 50, 32), this.mats.industrial);
        const dome = new THREE.Mesh(new THREE.SphereGeometry(8, 32, 16, 0, Math.PI * 2, 0, Math.PI / 2), this.mats.steel);
        dome.position.y = 25;
        cooking.add(towerMain, dome);
        // Complex platforms
        for (let i = 0; i < 4; i++) {
            const plat = this.createCatwalk(25, 25);
            plat.position.y = -20 + (i * 12);
            cooking.add(plat);
        }
        // External Piping
        for (let i = 0; i < 3; i++) {
            const pipe = new THREE.Mesh(new THREE.CylinderGeometry(1, 1, 45, 12), this.mats.steel);
            pipe.position.set(9, 0, i * 4 - 4);
            cooking.add(pipe);
        }
        addStage("Phase 2: Cooking Plant", cooking, "Unbleached Pulp", "Chips + White Liquor", "170°C High Pressure Digestion", { x: -spacing, y: 0, z: -spacing / 2 }, { x: 0, y: 60, z: 120 });

        // --- STAGE 3: WASHING & BLEACHING ASSEMBLY ---
        const washing = new THREE.Group();
        for (let i = 0; i < 3; i++) {
            const tankGroup = new THREE.Group();
            const tank = new THREE.Mesh(new THREE.CylinderGeometry(6, 6, 12, 32), this.mats.stainless);
            const walk = this.createCatwalk(15, 15);
            walk.position.y = 7;
            tankGroup.add(tank, walk);
            tankGroup.position.x = i * 20;
            washing.add(tankGroup);
        }
        addStage("Phase 3: Brownstock Washing", washing, "Clean Pulp + Black Liquor", "Unbleached Pulp", "Lignin Removal & Chemical Recovery", { x: 0, y: 0, z: -spacing / 2 }, { x: 20, y: 30, z: 80 });

        // --- STAGE 4: PULP MACHINE (THE "HERO" ASSEMBLY) ---
        const machine = new THREE.Group();
        const frameLength = 100;
        const mainFrame = new THREE.Mesh(new THREE.BoxGeometry(frameLength, 2, 20), this.mats.concrete);
        mainFrame.position.y = -8;
        machine.add(mainFrame);
        // Press Rollers
        for (let i = 0; i < 15; i++) {
            const roller = new THREE.Mesh(new THREE.CylinderGeometry(3, 3, 18, 32), this.mats.stainless);
            roller.rotation.z = Math.PI / 2;
            roller.position.set(-40 + (i * 6), -3, 0);
            machine.add(roller);
        }
        // Dryer Section Hood
        const hood = new THREE.Mesh(new THREE.BoxGeometry(30, 15, 22), this.mats.galvanized);
        hood.position.set(0, 5, 0);
        // Detailed catwalk on the machine
        const mWalk = this.createCatwalk(frameLength, 4);
        mWalk.position.set(0, 10, 11);
        machine.add(hood, mWalk);
        addStage("Phase 4: Pulp Machine", machine, "Finished Pulp Bales", "Bleached Pulp", "1,430 Adt/Day Production Capacity", { x: 1.5 * spacing, y: 0, z: -spacing / 2 }, { x: 0, y: 50, z: 150 });

        // --- STAGE 5: RECOVERY BOILER (THE MASSIVE ASSEMBLY) ---
        const boiler = new THREE.Group();
        const bMain = new THREE.Mesh(new THREE.BoxGeometry(30, 60, 30), this.mats.industrial);
        const bTop = new THREE.Mesh(new THREE.BoxGeometry(20, 10, 20), this.mats.galvanized);
        bTop.position.y = 35;
        const bStack = new THREE.Mesh(new THREE.CylinderGeometry(5, 5, 40, 32), this.mats.steel);
        bStack.position.set(-10, 55, 0);
        boiler.add(bMain, bTop, bStack);
        // Extensive Catwalks
        for (let i = 0; i < 6; i++) {
            const c = this.createCatwalk(40, 40);
            c.position.y = -25 + (i * 10);
            boiler.add(c);
        }
        addStage("Phase 5: Recovery Boiler", boiler, "Energy + Smelt Liquor", "Concentrated Black Liquor", "Mill Energy Regeneration Center", { x: -0.5 * spacing, y: 0, z: spacing / 2 }, { x: 50, y: 80, z: 180 });

        // --- STAGE 6: ENVIRONMENTAL SOLUTIONS ---
        const effluent = new THREE.Group();
        const tankBase = new THREE.Mesh(new THREE.CylinderGeometry(35, 35, 5, 64), this.mats.concrete);
        const water = new THREE.Mesh(new THREE.CylinderGeometry(34.5, 34.5, 4, 64), this.mats.glass);
        water.position.y = 1;
        const centralScraper = new THREE.Mesh(new THREE.BoxGeometry(60, 1, 1), this.mats.steel);
        centralScraper.position.y = 3.5;
        this.scraper = centralScraper;
        effluent.add(tankBase, water, centralScraper);
        addStage("Phase 6: Effluent Plant", effluent, "Environmental Compliance", "Mill Water", "Exceeding Global Protection Standards", { x: 0.5 * spacing, y: -5, z: spacing }, { x: 0, y: 60, z: 120 });

        this.flowPoints = this.stages.map(s => s.targetPos);
    }

    createPipeNetwork() {
        const pipeGroup = new THREE.Group();
        for (let i = 0; i < this.flowPoints.length - 1; i++) {
            const p1 = this.flowPoints[i];
            const p2 = this.flowPoints[i + 1];

            const curve = new THREE.CatmullRomCurve3([
                new THREE.Vector3(p1.x, 5, p1.z),
                new THREE.Vector3((p1.x + p2.x) / 2, 25, (p1.z + p2.z) / 2),
                new THREE.Vector3(p2.x, 5, p2.z)
            ]);

            const pipe = new THREE.Mesh(
                new THREE.TubeGeometry(curve, 64, 1.0, 8, false),
                new THREE.MeshStandardMaterial({ color: 0x3b82f6, emissive: 0x2563eb, emissiveIntensity: 0.5, transparent: true, opacity: 0.8 })
            );
            pipeGroup.add(pipe);

            // Flowing Particle
            const ball = new THREE.Mesh(new THREE.SphereGeometry(2, 16, 16), new THREE.MeshStandardMaterial({ color: 0xffffff, emissive: 0xffffff }));
            this.scene.add(ball);

            gsap.to({}, {
                duration: 4,
                repeat: -1,
                onUpdate: () => {
                    const t = (Date.now() % 4000) / 4000;
                    const pos = curve.getPoint(t);
                    ball.position.copy(pos);
                }
            });
        }
        this.scene.add(pipeGroup);
    }

    initControls() {
        this.controls = new OrbitControls(this.camera, this.renderer.domElement);
        this.controls.enableDamping = true;
        this.controls.dampingFactor = 0.05;
        this.controls.maxDistance = 1500;
        this.controls.minDistance = 20;
    }

    animate() {
        requestAnimationFrame(() => this.animate());
        this.controls.update();

        // Mechanical Animations
        if (this.debarkingDrum) {
            this.debarkingDrum.children[0].rotation.x += 0.005;
        }
        if (this.scraper) {
            this.scraper.rotation.y += 0.002;
        }

        this.renderer.render(this.scene, this.camera);
    }

    setupEventListeners() {
        window.addEventListener('resize', () => {
            if (!this.container) return;
            this.camera.aspect = this.container.clientWidth / this.container.clientHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
        });
        const nextBtn = document.getElementById('tour-next');
        const prevBtn = document.getElementById('tour-prev');
        if (nextBtn) nextBtn.addEventListener('click', () => this.goToStage(this.currentStage + 1));
        if (prevBtn) prevBtn.addEventListener('click', () => this.goToStage(this.currentStage - 1));
    }

    goToStage(index) {
        if (index < 0 || index >= this.stages.length) return;
        this.currentStage = index;
        const stage = this.stages[index];

        gsap.to(this.camera.position, {
            x: stage.cameraPos.x,
            y: stage.cameraPos.y,
            z: stage.cameraPos.z,
            duration: 2.2,
            ease: "power3.inOut"
        });

        gsap.to(this.controls.target, {
            x: stage.targetPos.x,
            y: 0,
            z: stage.targetPos.z,
            duration: 2.2,
            ease: "power3.inOut"
        });

        this.updateStageUI();
    }

    updateStageUI() {
        const stage = this.stages[this.currentStage];
        const uiMap = {
            'stage-title': stage.name,
            'stage-description': `Integrated Industrial Digital Twin: Precise Mechanical Visualization.`,
            'stage-input': stage.input,
            'stage-output': stage.output,
            'stage-technical': stage.technical,
            'phase-label': `UNIT PHASE ${this.currentStage + 1} / ${this.stages.length}`
        };

        Object.entries(uiMap).forEach(([id, val]) => {
            const el = document.getElementById(id);
            if (el) {
                gsap.fromTo(el, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.8, ease: "expo.out" });
                el.innerText = val;
            }
        });

        document.querySelectorAll('.timeline-dot').forEach((dot, idx) => {
            dot.style.transform = idx === this.currentStage ? 'scale(1.5)' : 'scale(1)';
            dot.style.background = idx === this.currentStage ? '#22c55e' : '#e2e8f0';
            dot.style.borderRadius = '2px';
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    window.pulpTour = new PulpProcessTour();
});
