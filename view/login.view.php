<style>

    .square {
        width: 500px;
        height: 500px;
        background-color: #E0E5FA;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
</head>
<body style="background-color: #C2C9EF;">



<section>
<div class="square rounded-lg shadow-2xl">    
    <div>
        <div>
            <form class="max-w-sm mx-auto fs-5">
                <div class="mt-40">
                    <label for="base-input" class="block mb-2 font-medium text-[#001459]"><strong> Cargo</strong></label>
                    <input type="text" id="base-input" class="bg-[#6C86B5] border border-inherit text-gray-900 rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2 ">
                </div>

                <label for="password" class="block mb-2 font-medium text-[#001459] mt-5"><strong>Contraseña</strong></label>
                <input type="password" id="password" class="bg-[#6C86B5]  text-gray-900 rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2 " required />

                <div class="text-center mt-10">
                    <button type="submit" class="text-white bg-[#27446E] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-4 text-center">INGRESAR</button>
                </div>

            </form>
        </div>
    </div>
</div>    
</section> 