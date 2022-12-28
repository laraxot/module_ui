 @php
     //non si visualizza bene, da aggiustare
     //esempio preso da https://codepen.io/fredjens/pen/adqLNO
     //dddx(get_defined_vars());
     //Theme::add('theme::css/radio_animated_switch.css');
 @endphp

 <style>
     .switch {
         position: relative;
         width: 14rem;
         padding: 0 1rem;
         font-family: verdana;

         &:before {
             content: '  ';
             position: absolute;
             left: 0;
             z-index: -1;
             width: 100%;
             height: 3rem;
             background: #000;
             border-radius: 30px;
         }

         &__label {
             display: inline-block;
             width: 2rem;
             padding: 1rem;
             text-align: center;
             cursor: pointer;
             transition: color 200ms ease-out;

             &:hover {
                 color: white;
             }
         }

         &__indicator {
             width: 4rem;
             height: 4rem;
             position: absolute;
             top: -.5rem;
             left: 0;
             background: blue;
             border-radius: 50%;
             transition: transform 600ms cubic-bezier(.02, .94, .09, .97),
                 background 300ms cubic-bezier(.17, .67, .14, 1.03);
             transform: translate3d(1rem, 0, 0);
         }

         input#one:checked~.switch__indicator {
             background: PaleGreen;
             transform: translate3d(1.2rem, 0, 0);
         }

         input#two:checked~.switch__indicator {
             background: MediumTurquoise;
             transform: translate3d(5.5rem, 0, 0);
         }

         input#three:checked~.switch__indicator {
             background: PaleVioletRed;
             transform: translate3d(10.6rem, 0, 0);
         }

         input[type="radio"] {

             &:not(:checked),
             &:checked {
                 display: none;
             }
         }
     }

     // Just for styling

     body {
         background: #333;
         color: #999;
         position: absolute;
         top: 50%;
         left: 50%;
         margin-left: -9rem;
         margin-top: -3rem;
     }

 </style>

 <div class="switch">
     <input name="switch" id="one" type="radio" checked />
     <label for="one" class="switch__label">One</label>
     <input name="switch" id="two" type="radio" />
     <label for="two" class="switch__label">Two</label>
     <input name="switch" id="three" type="radio" />
     <label for="three" class="switch__label">Three</label>
     <div class="switch__indicator" />
 </div>
 </div>
