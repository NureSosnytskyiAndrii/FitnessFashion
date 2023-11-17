<?php
global $mysqli;

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
<div class="container">
<h2>Exercise Cards</h2>
    <div class="row">
        <?php
        $sql = "SELECT exercise_id, name, description, difficulty, tags FROM exercise";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text"><strong>Difficulty:</strong> <?php echo $row['difficulty']; ?></p>
                            <p class="card-text"><strong>Tags:</strong> <?php echo $row['tags']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "0 results";
        }
        ?>
</div>
</div>

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
