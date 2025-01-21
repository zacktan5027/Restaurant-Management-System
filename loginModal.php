                    <style>
                        /* Full-width input fields */
                        input[type=text],
                        input[type=password] {
                            width: 100%;
                            padding: 12px 20px;
                            margin: 8px 0;
                            display: inline-block;
                            border: 1px solid #ccc;
                            box-sizing: border-box;
                        }

                        /* Set a style for all buttons */
                        .button {
                            background-color: #4CAF50;
                            color: white;
                            padding: 14px 20px;
                            margin: 8px 0;
                            border: none;
                            cursor: pointer;
                            width: 100%;
                        }

                        .button:hover {
                            opacity: 0.8;
                        }

                        /* Extra styles for the cancel button */
                        .cancelbtn {
                            width: auto;
                            padding: 10px 18px;
                            background-color: #f44336;
                        }

                        /* Center the image and position the close button */
                        .imgcontainer {
                            text-align: center;
                            margin: 24px 0 12px 0;
                            position: relative;
                        }

                        img.avatar {
                            width: 40%;
                            border-radius: 50%;
                        }

                        .container {
                            padding: 16px;
                        }

                        span.psw {
                            float: right;
                            padding-top: 16px;
                        }

                        /* The Modal (background) */
                        .modal {
                            display: none;
                            /* Hidden by default */
                            position: fixed;
                            /* Stay in place */
                            z-index: 1;
                            /* Sit on top */
                            left: 0;
                            top: 0;
                            width: 100%;
                            /* Full width */
                            height: 100%;
                            /* Full height */
                            overflow: auto;
                            /* Enable scroll if needed */
                            background-color: rgb(0, 0, 0);
                            /* Fallback color */
                            background-color: rgba(0, 0, 0, 0.4);
                            /* Black w/ opacity */
                            padding-top: 60px;
                        }

                        /* Modal Content/Box */
                        .modal-content {
                            background-color: #fefefe;
                            padding: 20px;
                            margin: auto;
                            /* 5% from the top, 15% from the bottom and centered */
                            border: 1px solid #888;
                            width: 70%;
                            /* Could be more or less, depending on screen size */
                        }

                        /* The Close Button (x) */
                        .close {
                            position: absolute;
                            right: 25px;
                            top: 0;
                            color: #000;
                            font-size: 35px;
                            font-weight: bold;
                        }

                        .close:hover,
                        .close:focus {
                            color: red;
                            cursor: pointer;
                        }

                        /* Add Zoom Animation */
                        .animate {
                            -webkit-animation: animatezoom 0.4s;
                            animation: animatezoom 0.4s
                        }

                        @-webkit-keyframes animatezoom {
                            from {
                                -webkit-transform: scale(0)
                            }

                            to {
                                -webkit-transform: scale(1)
                            }
                        }

                        @keyframes animatezoom {
                            from {
                                transform: scale(0)
                            }

                            to {
                                transform: scale(1)
                            }
                        }

                        /* Change styles for span and cancel button on extra small screens */
                        @media screen and (max-width: 300px) {
                            span.psw {
                                display: block;
                                float: none;
                            }

                            .cancelbtn {
                                width: 100%;
                            }
                        }
                    </style>

                    <?php if (!isset($_SESSION['user'])) { ?>
                        <li class="nav-item"><a class="nav-link" href='#' onclick="document.getElementById('id01').style.display='block'">Sign in</a></li>
                        </ul>
                        <div id="id01" class="modal">
                            <form class="modal-content animate" action="loginManager.php" method="post">
                                <div class="imgcontainer">
                                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                    <h1>SIGN IN</h1>
                                </div>
                                <div class="container">
                                    <label for="uname"><b>Username</b></label>
                                    <input type="text" placeholder="Enter Username" name="AccountUsername" maxlength="30" required>
                                    <label for="psw"><b>Password</b></label>
                                    <input type="password" placeholder="Enter Password" name="AccountPassword" maxlength="30" required>
                                    <button class="btn btn-main" type="submit" name="login">Login</button>
                                </div>
                                <div class="container">
                                    <span>Do not have an account? <a href="register.php">Sign up</a> now </span>
                                </div>
                                <div class="container" style="background-color:#f1f1f1">
                                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-dark">Cancel</button>
                                    <span class="psw"><a href="forgetpasswordindex.php">Forgot password?</a></span>
                                </div>
                            </form>
                        </div>
                    <?php } else {
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        session_destroy();
                        // Redirect to the login page:
                        header('Location: index.php');
                    } ?>