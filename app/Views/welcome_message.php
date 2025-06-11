<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Actor&family=Alegreya:ital,wght@0,400..900;1,400..900&family=Aleo:ital,wght@0,100..900;1,100..900&family=Gowun+Batang&family=Gravitas+One&family=Katibeh&family=Marcellus&family=Purple+Purse&family=Quattrocento:wght@400;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sree+Krushnadevaraya&display=swap" rel="stylesheet">
    <title>Home</title>
    <link href="<?= base_url() ?>css/style.css" rel="stylesheet" />
</head>

<body class=" antialiased font-normal leading-default bg-[#F6F6F6] text-black">
    <!-- navbar -->
    <nav class="bg-carrot-2 flex w-full h-16 px-10 justify-between items-center">
        <h1 class="font-katibeh text-9 mb-2">CALMHEALTH</h1>
        <div class="flex gap-16 font-abrill text-6">
            <a href="#">Home</a>
            <a href="login">Therapy</a>
            <a href="login">Article</a>
        </div>
        <a href="login" class="border-2 font-abrill border-black px-4 text-6">Log In</a>
    </nav>

    <!-- main -->
    <main class="px-10">
        <div class="flex px-10">
            <div class="flex flex-col mt-68 -mr-36">
                <h1 class="font-gowun-batang text-16 -mb-7">Embrace your</h1>
                <h1 class="font-purple-purse text-24 -mb-9">MENTAL</h1>
                <h1 class="font-purple-purse text-24 ">HEALT</h1>
                <div>
                    <a href="login" class="border-2 font-gravitas-one text-3 border-black px-4 py-3">BOOK AN APPOINTMENT</a>
                </div>
            </div>
            <div class="">
                <img src="/img/img.png" class="w-full" alt="">
            </div>
        </div>
        <div class="flex justify-end my-10">
            <a href="login" class="border-2 font-gravitas-one text-3 border-black px-4 py-3">Read Article</a>
        </div>
        <h1 class="font-quattrocento text-16 -mb-7">We help people living with a variety</h1>
        <h1 class="font-quattrocento text-16 mb-5">of mental healt conditions.</h1>
        <div class="bg-carrot-2 h-[5px] w-full mb-5"></div>
        <div class="flex justify-between gap-4 mb-30">
            <div class="flex flex-col justify-center items-center">
                <img src="/img/img4.png" class="w-full" alt="">
                <h1 class="font-gowun-batang text-10 font-bold">Personality Disorders</h1>
                <p class="font-gowun-batang text-6 px-10 text-center">Personality disorders are a group
                    of mental illnesses.</p>
            </div>
            <div class="flex flex-col justify-center items-center gap-1">
                <img src="/img/img3.png" class="w-full" alt="">
                <h1 class="font-gowun-batang text-10 font-bold">Depression</h1>
                <p class="font-gowun-batang text-6 px-10 text-center">Depression is a common and serious
                    medical illness.</p>
            </div>
            <div class="flex flex-col justify-center items-center gap-1">
                <img src="/img/img2.png" class="w-full" alt="">
                <h1 class="font-gowun-batang text-10 font-bold">Anxiety</h1>
                <p class="font-gowun-batang text-6 px-10 text-center">Anxiety is a feeling offear, deard and
                    un easiness.</p>
            </div>

        </div>
    </main>
</body>

</html>