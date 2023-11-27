<?php
global $mysqli;

?>

<section aria-label="Newest Photos">
    <div class="carousel"  data-carousel>
        <button class="carousel-button prev" data-carousel-button="prev">&#8656</button>
        <button class="carousel-button next" data-carousel-button="next">&#8658</button>
    <ul data-slides>
        <li class="slide" data-active>
            <img src="../src/29.jpg" alt="">
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
<style>
    .user-info {
        display: flex;
        align-items: center;
    }

    .user-info i {
        margin-left: 10px;
    }

    .about-us-container {
        background-color: #f8f9fa;
        padding: 40px;
        border-radius: 10px;
        margin-top: 20px;
    }

    .about-us-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 20px;
    }

    .about-us-text {
        font-size: 1.2rem;
        color: #6c757d;
    }
</style>

<div class="container mt-4 mb-4">
    <div class="about-us-container">
        <h2 class="about-us-title text-center">Our trainers</h2>
        <div class="row">
<?php
$sql = "SELECT users.*, trainer.*, training.training_name, training.training_description FROM 
        users INNER JOIN trainer ON users.user_id = trainer.trainer_id 
        LEFT JOIN training ON trainer.trainer_id = training.trainer_id                                                                           
        WHERE users.user_role = 'trainer'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        ?>
            <div class="col-md-4 mt-4">
                <div class="card mb-4">
                    <div class="user-info">
                        <i class="fa-solid fa-3x fa-user"></i>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["username"]; ?></h5>
                            <p class="card-text"><span
                                        class="text-success">Experience:</span> <?php echo $row["experience"]; ?> years
                            </p>
                            <p class="card-text"><span
                                        class="text-success">Specialization:</span> <?php echo $row["specialization"]; ?>
                            </p>
                            <p class="card-text"><span class="text-success">Phone:</span> <?php echo $row["phone"]; ?>
                            </p>

                            <!-- Accordion for training information -->
                            <div class="accordion mt-3" id="accordion<?php echo $row["trainer_id"]; ?>">
                                <div class="card">
                                    <div class="card-header" id="headingOne<?php echo $row["trainer_id"]; ?>">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapseOne<?php echo $row["trainer_id"]; ?>"
                                                    aria-expanded="true"
                                                    aria-controls="collapseOne<?php echo $row["trainer_id"]; ?>">
                                                Training Information
                                                <i class="fas fa-chevron-down"></i> <!-- Arrow icon -->
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne<?php echo $row["trainer_id"]; ?>" class="collapse"
                                         aria-labelledby="headingOne<?php echo $row["trainer_id"]; ?>"
                                         data-parent="#accordion<?php echo $row["trainer_id"]; ?>">
                                        <div class="card-body">
                                            <p><strong>Training Name:</strong> <?php echo $row["training_name"]; ?></p>
                                            <p><strong>Training
                                                    Description:</strong> <?php echo $row["training_description"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Accordion for training information -->
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
}
?>
        </div>
        <div style="display:flex; justify-content: center; margin-bottom: 30px;"><a type="button" class="btn btn-primary"  href="/?page=exercises_categories">Exercises for you &nbsp; <img src="../src/free-icon-sport-6106456%20(1).png"/></a></div>
        <h2 class="about-us-title text-center">About us</h2>
        <p class="about-us-text mb-2 mt-2">
            Our company provides high-quality online training for all sports. We strive
            to make sports accessible to everyone, regardless of the level of training.
        </p>
        <p class="about-us-text mb-2 mt-2"">
            With our experienced trainers, you can achieve your goals, whether it's improving your fitness,
            gaining muscle mass or improving sports skills.
        </p>
        <p class="about-us-text mb-2 mt-2"">
            We stand out by providing personalized training programs as well as supporting our own
            clients at every stage of their fitness journey.
        </p>
        <p class="about-us-text mb-2 mt-2"">
            Join us today and start your journey to health, strength and success with our company!
        </p>
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