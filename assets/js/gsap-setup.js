jQuery(document).ready(function($) {
    // Register ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    // 1. Section Animations
    $('.animate-section').each(function() {
        gsap.from($(this), {
            scrollTrigger: {
                trigger: $(this),
                start: "top 100%", // When top of element hits 80% of viewport
                toggleActions: "play none none none", // Play on enter, no other actions
                markers: false // Set to true for debugging (shows trigger positions)
            },
            duration: 0.3,
            opacity: 0,
            y: 40,
            ease: "power2.out"
        });
    });

    // 2. Post/Item Animations - trigger at 10% visibility as requested
    $('.animate-items').each(function(index) {
        gsap.from($(this), {
            scrollTrigger: {
                trigger: $(this),
                start: "top 100%", // Triggers when 10% of item is visible (top 90% of viewport)
                toggleActions: "play none none none"
            },
            duration: 0.4, // Slightly longer duration for smoother effect
            opacity: 0,
            y: 20, // Reduced from 40 to 20 for subtler movement
            delay: index * 0.08, // Reduced delay between items
            ease: "power2.out"
        });
    });
    // 3. Text Animations
    $('.animate-text').each(function(index) {
        gsap.from($(this), {
            scrollTrigger: {
                trigger: $(this),
                start: "top 90%",
                toggleActions: "play none none none"
            },
            duration: 0.3,
            opacity: 0,
            y: 20,
            delay: index * 0.05, // Very small delay between paragraphs
            ease: "power2.out"
        });
    });

    // 4. Heading Animations
    $('.animate-heading').each(function() {
        gsap.from($(this), {
            scrollTrigger: {
                trigger: $(this),
                start: "top 85%",
                toggleActions: "play none none none"
            },
            duration: 0.3,
            opacity: 0,
            y: 30,
            ease: "back.out(1.2)" // Slightly bouncy animation for headings
        });
    });
});