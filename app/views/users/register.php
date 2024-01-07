<?php require APPROOT . '/views/inc/header.php' ?>
<header class="flex bg-white shadow justify-between items-center px-4">
    <img class="lg:h-[7vh] h-12 inline-block m-2" src="<?php echo URLROOT; ?>/img/logo.png" alt="Workflow">
    <div>
    <a href="<?php echo URLROOT;?>/users/login" class="p-[8px] w-fit h-fit text-center text-[#1062d4] text-md font-medium bg-white rounded-full">Login</a>
    <a href="<?php echo URLROOT;?>/users/register" class="p-[8px] w-fit h-fit text-center text-white text-md font-medium  bg-[#1062d4] rounded hover:bg-white hover:text-black">SignUp</a>
  </div>
</header>



<div class=" lg:flex-row lg:justify-evenly lg:items-center flex flex-col items-center m-8 ">

    <img class="lg:w-2/5 w-4/5 " src="<?php echo URLROOT; ?>/img/Artboard.png" alt="">

    <div class="my- border-2 border-black  flex flex-col items-center p-2">

        <h1 class="font-semibold underline" id="heading">Sign Up Form</h1><br>
        <form class="  flex flex-col items-center" enctype="multipart/form-data" action="<?php echo URLROOT; ?>/users/register" method="POST">

            <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Product Photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                <input type="file" id="product_picture" name="product_picture" class="sr-only ">
                                </label>
                            </div>
                            <input type="file" name="product_picture" class="<?php echo (!empty($data['product_picture_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['product_picture'];?>">
                            <span class="invalid-feedback text-red-500"><?php echo $data['product_picture_err']; ?></span>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF</p>

                   
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex gap-2 items-center">
                <i class="fa fa-user fa-lg"></i>
                <input class="border-2 border-black rounded w-[250px] p-1  <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" type="text" id="user" name="name" placeholder="Enter Username" ></br></br>

            </div>
            <span class="invalid-feedback text-red-500"><?php echo $data['name_err']; ?></span>
            <div class="flex gap-2 items-center"><i class="fa fa-user fa-lg"></i>
                <input class="border-2 border-black rounded w-[250px] p-1  <?php echo (!empty($data['userlastname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['userlastname']; ?>" type="text" id="user" name="userlastname" placeholder="Enter Userlastname"></br></br>

            </div>
            <span class="invalid-feedback text-red-500"><?php echo $data['userlastname_err']; ?></span>
            <div class="flex gap-2 items-center">
                <i class="fa-solid fa-phone"></i>
                <input class="border-2 border-black rounded  w-[250px] p-1  <?php echo (!empty($data['phoneNumber_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phoneNumber']; ?>" type="text" id="user" name="phoneNumber" placeholder="Enter Yourphonenumber"></br></br>
            </div>
            <span class="invalid-feedback text-red-500"><?php echo $data['phoneNumber_err']; ?></span>
            <div class="flex gap-2 items-center"><i class="fa-solid fa-envelope fa-lg"></i>
                <input class="border-2 border-black rounded w-[250px] p-1 <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" type="email" id="email" name="email" placeholder="Enter Email"></br></br>

            </div>
            <span class="invalid-feedback text-red-500"><?php echo $data['email_err']; ?></span>
            <div class="flex gap-2 items-center"><i class="fa-solid fa-lock fa-lg"></i>
                <input class="border-2 border-black rounded w-[250px] p-1   <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?> " value="<?php echo $data['password']; ?>" type="password" id="pass" name="password" placeholder="Create Password"></br></br>

            </div>
            <span class="invalid-feedback text-red-500"><?php echo $data['password_err']; ?></span>
            <div class="flex gap-2 items-center"><i class="fa-solid fa-lock fa-lg"></i>
                <input class="border-2 border-black rounded w-[250px] p-1 <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?> " value="<?php echo $data['confirm_password']; ?>" type="password" id="cpass" name="confirm_password" placeholder="Retype Password"></br></br>

            </div>
            <span class="invalid-feedback text-red-500"><?php echo $data['confirm_password_err']; ?></span>
            <input class=" bg-[#2596ec] border-2 border-black rounded w-[285px] p-1" type="submit" id="btn" value="SignUp" name="submit" />
        </form>

        <h4>I have already an Account? <a class="text-red-600 underline" href="<?php echo URLROOT; ?>/users/login">Login </a></h4>

    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>