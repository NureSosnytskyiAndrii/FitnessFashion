<?php
?>

<section aria-label="Newest Photos">
    <div class="carousel"  data-carousel>
        <button class="carousel-button prev" data-carousel-button="prev">&#8656</button>
        <button class="carousel-button next" data-carousel-button="next">&#8658</button>
    <ul data-slides>
        <li class="slide" data-active>
            <img src="../src/24.jpg" alt="">
        </li>
        <li class="slide">
            <img src="../src/26.jpg" alt="">
        </li>
        <li class="slide">
            <img src="../src/28.png" alt="">
        </li>
        <li class="slide">
            <img src="../src/30.png" alt="">
        </li>
    </ul>
    </div>
</section>
<script>
    const buttons = document.querySelectorAll("[data-carousel-button]")

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            const offset = button.dataset.carouselButton === "next" ? 1 : -1
            const slides = button
                .closest("[data-carousel]")
                .querySelector("[data-slides]")

            const activeSlide = slides.querySelector("[data-active]")
            let newIndex = [...slides.children].indexOf(activeSlide) + offset
            if (newIndex < 0) newIndex = slides.children.length - 1
            if (newIndex >= slides.children.length) newIndex = 0

            slides.children[newIndex].dataset.active = true
            delete activeSlide.dataset.active
        })
    })
</script>
