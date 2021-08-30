<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div x-data="{tab : 'tab1'}" class="">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a x-on:click.prevent="tab ='tab1'" :class="tab === 'tab1' ? 'active' : ''" class="nav-link"
                    href="#">tab1</a>
            </li>
            <li class="nav-item">
                <a x-on:click.prevent="tab ='tab2'" :class="tab === 'tab2' ? 'active' : ''" class="nav-link"
                    href="#">tab2</a>
            </li>
            <li class="nav-item">
                <a x-on:click.prevent="tab ='tab3'" :class="tab === 'tab3' ? 'active' : ''" class="nav-link"
                    href="#">tab3</a>
            </li>
        </ul>
        <div x-show="tab === 'tab1'">tab1 Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis iste
            excepturi repellat facilis nam ipsum quaerat iusto ipsa dignissimos. Nisi, odio reiciendis laborum aliquid
            officia unde assumenda? Est, nobis iste!</div>
        <div x-show="tab === 'tab2'">tab2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, quae
            iusto ipsum sed distinctio dolor, sunt, perferendis dolorem est commodi placeat voluptatum? Adipisci officia
            magnam hic animi. Nostrum, neque ut.</div>
        <div x-show="tab === 'tab3'">tab3 Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure necessitatibus
            voluptate sit rerum. Ducimus facilis illo temporibus voluptates sit voluptatem quisquam laborum sint, atque
            officiis. Eos placeat libero illum inventore.</div>
    </div>





    <script src="{{ asset('js/alpine.js') }}"></script>

</body>

</html>
