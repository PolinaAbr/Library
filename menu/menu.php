<div id="menu" class="menu main-menu">
    <a href="index.php" class="section" id="home">
        √À¿¬Õ¿ﬂ
    </a>
    <?php
    if ($page == "books")
    {
        echo "<a href='books.php' class='section active'> Õ»√»</a>";
    }
    else
    {
        echo "<a href='books.php' class='section'> Õ»√»</a>";
    }
    if ($page == "genres")
    {
        echo "<a href='genres.php' class='section active'>∆¿Õ–€</a>";
    }
    else
    {
        echo "<a href='genres.php' class='section'>∆¿Õ–€</a>";
    }
    if ($page == "authors")
    {
        echo "<a href='authors.php' class='section active'>¿¬“Œ–€</a>";
    }
    else
    {
        echo "<a href='authors.php' class='section'>¿¬“Œ–€</a>";
    }
    ?>
</div>
