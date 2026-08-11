@props([
    'color' => '#FB2C6B',
    'density' => 60,
    'class' => ''
])
@php
    $id = 'canvas-particles-' . uniqid();
@endphp
<canvas id="{{ $id }}" class="absolute inset-0 pointer-events-auto z-[1] {{ $class }}" style="opacity: 0.6;"></canvas>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('{{ $id }}');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let particles = [];
    const mouse = { x: 0, y: 0, active: false };
    let animationFrameId;

    const resize = () => {
        const parent = canvas.parentElement;
        if (!parent) return;
        canvas.width = parent.clientWidth;
        canvas.height = parent.clientHeight;
        init();
    };

    const init = () => {
        particles = [];
        const particleCount = (canvas.width * canvas.height) / ({{ $density }} * 200);
        
        for (let i = 0; i < particleCount; i++) {
            const x = Math.random() * canvas.width;
            const y = Math.random() * canvas.height;
            const size = Math.random() * 2 + 1;
            const speedX = Math.random() * 1 - 0.5;
            const speedY = Math.random() * 1 - 0.5;
            
            particles.push({
                x,
                y,
                size,
                speedX,
                speedY,
                color: '{{ $color }}',
                originX: x,
                originY: y
            });
        }
    };

    const animate = () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        particles.forEach((p) => {
            p.x += p.speedX;
            p.y += p.speedY;

            if (p.x < 0 || p.x > canvas.width) p.speedX *= -1;
            if (p.y < 0 || p.y > canvas.height) p.speedY *= -1;

            if (mouse.active) {
                const dx = mouse.x - p.x;
                const dy = mouse.y - p.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                const forceDirectionX = dx / distance;
                const forceDirectionY = dy / distance;
                const maxDistance = 150;
                const force = (maxDistance - distance) / maxDistance;

                if (distance < maxDistance) {
                    p.x -= forceDirectionX * force * 5;
                    p.y -= forceDirectionY * force * 5;
                }
            }

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fillStyle = p.color;
            
            if (Math.random() > 0.95) {
                ctx.shadowBlur = 15;
                ctx.shadowColor = p.color;
            } else {
                ctx.shadowBlur = 0;
            }
            
            ctx.fill();
        });

        animationFrameId = requestAnimationFrame(animate);
    };

    const handleMouseMove = (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
        mouse.active = true;
    };

    const handleMouseLeave = () => {
        mouse.active = false;
    };

    const handleTouchMove = (e) => {
        if (e.touches.length > 0) {
            const rect = canvas.getBoundingClientRect();
            mouse.x = e.touches[0].clientX - rect.left;
            mouse.y = e.touches[0].clientY - rect.top;
            mouse.active = true;
        }
    };

    window.addEventListener('resize', resize);
    canvas.addEventListener('mousemove', handleMouseMove);
    canvas.addEventListener('mouseleave', handleMouseLeave);
    canvas.addEventListener('touchmove', handleTouchMove);

    resize();
    animate();
});
</script>
