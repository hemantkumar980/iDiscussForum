<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <title>Welcome to iDiscuss - Coding Forums</title>
    <link rel="icon" type="image/x-icon" href="images/weblogo.png">
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <header>
        <?php include 'partials/_header.php'; ?>
    </header>

    <div class="container my-3" style="min-height:650px;">

        <main role="main" class="py-2">
            <h1 class="cover-heading text-center pt-1">About Us</h1>
            <hr>
            <p class="lead">Welcome to iDiscuss Forum, the online community where like-minded individuals come together
                to discuss, share, and connect on a wide range of topics. Whether you're a passionate enthusiast, a
                curious learner, or just someone looking for a friendly space to interact with others, you've found the
                right place!</p>

            <h1 class="cover-heading text-center pt-3">Our Mission</h1>
            <hr>
            <p class="lead">At iDiscuss Forum, our mission is to foster a supportive and inclusive online environment
                where people from all walks of life can engage in meaningful conversations. We believe in the power of
                knowledge, the strength of diverse perspectives, and the joy of connecting with people who share your
                interests and passions.</p>

            <h1 class="cover-heading text-center pt-3">What We Offer</h1>
            <hr>
            <p class="lead">
                <b>Vibrant Community:</b> Our community is built on the values of respect, courtesy, and openness.
                You'll meet people who are as passionate as you are about the things you love.<br>

                <b>Diverse Topics:</b> Our forum covers a multitude of topics, from technology and arts to sports and
                travel. You're sure to find a corner of our forum that piques your interest.<br>

                <b>Knowledge Sharing:</b> Engage in insightful discussions, share your expertise, and learn from others.
                Our forum is a hub for knowledge exchange.<br>

                <b>Privacy and Security:</b> We take your online security and privacy seriously. Our platform is
                designed with the latest security measures to ensure a safe experience.<br>
                <b>User-Friendly Interface:</b> Navigating our forum is a breeze. Our user-friendly interface allows you to easily find and participate in discussions.
            </p>

            <h1 class="cover-heading text-center pt-3">Our Team</h1>
            <hr>
            <p class="lead">Behind iDiscuss Forum is a dedicated team of moderators and administrators who work
                tirelessly to ensure a positive and enriching environment for our users. We are here to address any
                concerns, maintain community guidelines, and keep the discussions flowing smoothly.</p>

            <h1 class="cover-heading text-center pt-3">Join Us Today</h1>

            <p class="lead">We invite you to join our growing community at iDiscuss Forum and become a part of something
                special. Share your thoughts, ask questions, offer advice, or simply connect with people who share your
                interests. This is your space, and we can't wait to see what you bring to the table.</p>

            <h1 class="cover-heading text-center pt-3">Contact Us</h1>
            <hr>
            <p class="lead">If you have any questions, suggestions, or feedback, please feel free to reach out to us at
                <em><a href="mailto:rajpoothemant980@gmail.com"> rajpoothemant980@gmail.com</a></em><br>

                Thanks for being a part of iDiscuss Forum, and we look forward to getting to know you better within our vibrant online community.
                <br>
            <p class="text-right">
                Warm regards,<br>
                
                iDiscuss Forum Team</p>
            </p>

        </main>
    </div>
    <footer class="bg-dark text-center text-white">
        <?php include 'partials/_footer.php'; ?>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>