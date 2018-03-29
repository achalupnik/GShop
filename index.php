<?php
include "Includes/head.php";
include "Includes/menu.php";
?>


    Stack Overflow
    Questions
    Developer Jobs
    Tags
    Users

    Search…

    Log In Sign Up
    The results are in! See the 2018 Developer Survey results. »
    Join Stack Overflow to learn, share knowledge, and build your career.

    Email Sign Up
    OR SIGN IN WITH
    Google
    Facebook
    How to remove border (outline) around text/input boxes? (Chrome) [duplicate]
    Ask Question
    up vote
    914
    down vote
    favorite
    175
    This question already has an answer here:

    How to remove the border highlight on an input text element 11 answers
    Can anyone explain how to remove the orange or blue border (outline) around text/input boxes? I think it only happens on Chrome to show that the input box is active. Here's the input CSS I'm using:

    input {
    background-color: transparent;
    border: 0px solid;
    height: 20px;
    width: 160px;
    color: #CCC;
    }
    enter image description here

    css google-chrome input border
    shareimprove this question
    edited Jun 23 '15 at 23:02

    Cyral
    11.2k42963
    asked Aug 3 '10 at 13:49

    Joey Morani
    7,6352362115
    marked as duplicate by Martijn Pieters♦ Jun 24 '15 at 13:52
    This question has been asked before and already has an answer. If those answers do not fully address your question, please ask a new question.

    note that oulines also appear in different cases: in IE9 you can see little dots around a button if you select it using tab (ie. you click inside a field before the button & go to the next fields using Tab until you reach the button [going to previous field is Shift + Tab]) – Adrien Be Feb 11 '13 at 10:32
    add a comment
    11 Answers
    active oldest votes
    up vote
    1694
    down vote
    accepted
    This border is used to show that the element is focused (i.e. you can type in the input or press the button with Enter). You can remove it, though:

    textarea:focus, input:focus{
    outline: none;
    }
    You may want to add some other way for users to know what element has keyboard focus though for usability.

    Chrome will also apply highlighting to other elements such as DIV's used as modals. To prevent the highlight on those and all other elements as well, you can do:

    *:focus {
    outline: none;
    }
    shareimprove this answer
    edited Jan 5 '16 at 20:34

    Chuck Le Butt
    25.8k41141215
    answered Aug 3 '10 at 13:52

    CEich
    17.4k11014
    17
    This is not working for me. I am using Chrome, latest update. I put input:focus {outline: 0;} in the CSS, but when I type, the blue Mac outline is still there. – Joe P. Nov 5 '13 at 20:29
    43
    Use outline: none – aceofspades Jun 15 '14 at 16:00
    4
    outline-style: none works well with Chromium (version 34) and Firefox (version 30) – Nantoka Jun 16 '14 at 13:53
    39
    It's bad for accessibility to remove this outline that is default on :focus. This means that users using the keyboard to navigate will have a hard time seeing which link/item is highlighted when they hit tab. If anything, the highlighting of the element should be enhanced to make it more obvious which item has focus. – Torkil Johnsen Jul 25 '14 at 12:46
    20
    @TorkilJohnsen, While I agree 100% that the element should be visibly focused the default blue/orange ring behaviour is not always the right strategy. As long as some strategy is adopted (and adopted consistently across a design system) then CSS should be authored to support that decision. – Crispen Smith Jan 27 '15 at 2:47
    show 7 more comments
    up vote
    82
    down vote
    The current answer didn't work for me with Bootstrap 3.1.1. Here's what I had to override:

    .form-control:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
    }
    shareimprove this answer
    answered Feb 21 '14 at 3:43

    gwintrob
    1,0221012
    4
    box-shadow: none; did the trick for me. When I put in on the element without :focus it also removes a very subtle shadow that Chrome puts on border-less and input boxes. – Tim Scott Dec 19 '14 at 4:21
    This worked for me. For some reason input:focus { outline:none;} did not work. – AlmostPitt Nov 1 '17 at 20:58
    Thank you it's work 100% – Osama khodrog Dec 17 '17 at 11:25
    This worked for me. I am using FF latest browser and outline: none is not working. – Narendra Verma Jan 3 at 8:10
    This solution also works for bootstrap v4. – Steve Snow Feb 21 at 2:08
    add a comment
    up vote
    81
    down vote
    input:focus {
    outline:none;
    }
    This will do. Orange outline won't show up anymore.

    shareimprove this answer
    edited Dec 14 '15 at 0:31

    hichris123
    7,179114161
    answered Aug 3 '10 at 13:52

    azram19
    1,22976
    2
    Instead of input:focus{ outline: 0; } -> outline:none; Works – BetaCoder Jan 14 '14 at 8:18
    11
    Don't do it unless you provide some other styling, it's important for accesability. see outlinenone.com – mattumotu Jul 29 '14 at 15:17
    1
    Actually, this CSS isn't enough. For example, if you're using JQueryUI tabs, the ugly blue border appears after you click on a tab, if you just use your CSS. You do need to add a:focus or li:focus, to prevent the border. – Mike Gledhill Dec 30 '14 at 13:16
    add a comment
    up vote
    40
    down vote
    <input style="border:none" >
    Worked well for me. Wished to have it fixed in html itself... :)

    shareimprove this answer
    edited May 25 '17 at 5:28
    answered Oct 8 '14 at 7:26

    Kailas
    3,88412649
    2
    <input style="border:0px" > also works, as well. – fuzzyanalysis Jan 6 '15 at 4:21
    you can triple that: input { border: 0 none transparent } – Leo Nov 21 '16 at 21:55
    When I add border:none to a css class, its still showing the border for the input field. where as the inline css style="border:none" is working – arun8 Sep 14 '17 at 17:15
    add a comment
    up vote
    31
    down vote
    I've found the solution.
    I used: outline:none; in the CSS and it seems to have worked. Thanks for the help anyway. :)

    shareimprove this answer
    answered Aug 3 '10 at 13:51

    Joey Morani
    7,6352362115
    3
    That's the focus outline you are removing. It's there for a reason: Usability. Especially keyboard users will hate it if you remove it. – RoToRa Aug 3 '10 at 14:00
    21
    @RoToRa what if he crafts a better one using shadows CSS 3 ? – ShrekOverflow Feb 17 '12 at 15:09
    add a comment
    up vote
    19
    down vote
    Solution

    *:focus {
    outline: 0;
    }
    PS: Use outline:0 instead of outline:none on focus. It's valid and better practice.

    shareimprove this answer
    edited Jul 16 '17 at 3:31

    BSMP
    2,22852034
    answered May 23 '13 at 9:55

    Touhid Rahman
    1,8411320
    add a comment
    up vote
    18
    down vote
    this remove orange frame in chrome from all and any element no matter what and where is it

    *:focus {
    outline: none;
    }
    shareimprove this answer
    answered Oct 10 '12 at 20:43

    nonamehere
    19922
    add a comment
    up vote
    15
    down vote
    Please use the following syntax to remove the border of text box and remove the highlighted border of browser style.

    input {
    background-color:transparent;
    border: 0px solid;
    height:30px;
    width:260px;
    }
    input:focus {
    outline:none;
    }
    shareimprove this answer
    edited Aug 6 '13 at 21:45

    daniel__
    6,442104983
    answered May 8 '13 at 8:55

    Tabish
    753611
    Be careful with the transparent definition on the background-color attribute. You don't need that and you probably will have a big problem when you need to write something (you won't find the inputs!). By the way, personally, I would change the transparent background to select a color. For example, if my container has a red color, I would use a white background on the input. – Gilberto Sánchez Dec 28 '16 at 21:07
    add a comment
    up vote
    9
    down vote
    I found out that you can also use:

    input:focus{
    border: transparent;
    }
    shareimprove this answer
    edited May 6 '15 at 13:27

    bgilham
    4,86311434
    answered May 6 '15 at 12:51

    Refilon
    2,21311332
    add a comment
    up vote
    9
    down vote
    This will definitely work. Orange outline will not show anymore.. Common for all tags:

    *:focus {
    outline: none;
    }
    Specific to some tag, ex: input tag

    input:focus {
    outline:none;
    }
    shareimprove this answer
    edited Dec 14 '15 at 0:32

    hichris123
    7,179114161
    answered Apr 19 '13 at 6:51

    Prashant Gupta
    423610
    add a comment
    up vote
    8
    down vote
    Set

    input:focus{
    outline: 0 none;
    }
    "!important" is just in case. That's not necessary. [And now it's gone. –Ed.]

    shareimprove this answer
    edited Sep 15 '15 at 14:28

    Ivanka Todorova
    5,285104272
    answered Sep 5 '13 at 15:28

    madd
    15315
    19
    Don't use !important unless you REALLY MUST use it. – Mackelito Nov 20 '13 at 9:04
    @Mackelito You must use !important to work with Bootstrap – Rob Feb 9 '17 at 16:54
    add a comment
    protected by Community♦ Feb 15 '12 at 13:08
    Thank you for your interest in this question. Because it has attracted low-quality or spam answers that had to be removed, posting an answer now requires 10 reputation on this site (the association bonus does not count).

    Would you like to answer one of these unanswered questions instead?

    Not the answer you're looking for? Browse other questions tagged css google-chrome input border or ask your own question.
    asked

    7 years, 7 months ago

    viewed

    1,153,858 times

    active

    8 months ago

    BLOG
    Quantum Computing Site Launches with the Help of Strangeworks
    Want a php job?
    Web-Developer, der für CMS brennt
    Fachhochschule WedelWedel, Deutschland
    phpcss
    Web-Applikations-Entwickler (m/w)
    bulwiengesa AGMünchen, Deutschland
    phpjavascript
    PHP Developer (m/w) Remote - Homeoffice
    Inpsyde GmbHNo office location
    €25K - €48KREMOTE
    phpjavascript
    High response rate
    Web Developer / Senior Web Developer (Educational Technology)
    Doublestruck LtdLondon, UK
    £35K - £50K
    phphtml
    Linked
    440
    How to remove the border highlight on an input text element
    286
    How to reset / remove chrome's input highlighting / focus border?
    34
    How to get rid of text box selection highlight on Chrome/Safari?
    10
    Disabling Webkit Form Input Shadow
    4
    Remove Check Box blue border
    3
    get rid of rectangle around rouded boxes
    0
    How to remove the blue color box in inputs and button in bootstrap if its clicked
    0
    Border of a selected element in Jquery
    -1
    Add/Remove border on-click Android Java
    0
    Avoid textbox Border onfocus?
    see more linked questions…
    Related
    1929
    How do I give text or an image a transparent background using CSS?
    4171
    How to disable text selection highlighting?
    440
    How to remove the border highlight on an input text element
    411
    Removing input background colour for Chrome autocomplete?
    1683
    How do I vertically center text with CSS?
    1214
    How do I get ASP.NET Web API to return JSON instead of XML using Chrome?
    23
    Webkit CSS to control the box around the color in an input[type=color]?
    42
    remove inner shadow of text input
    443
    Remove blue border from css custom-styled button in Chrome
    0
    Rendering overlay to div with border radius and overflow: hidden (Chrome only)
    Hot Network Questions
    Can any time on clock be spoken as it is in numbers only (hour + minutes)?
    What characters in Game of Thrones have been recast?
    Why is there a need for getting rid of ISS trash using the empty ATV and similar veichles
    How to stop people from looking at my mouth when we're having a conversation?
    Is anything preventing non-US citizens from illegally registering to vote in non-Voter-ID states?
    Is there a standard ISO language code for ”other”?
    Editor rejected manuscript claiming it is similar to a not-yet-published manuscript (that I haven't seen). How to proceed?
    Looking for a 70s movie with a generation ship that had farming modules
    Can I use the name Valerian in my sci-fi novel?
    Why use 2.048V and 4.096 as a reference?
    What shape of a ship would be most effective in real life space combat?
    The Bitcoin.it wiki says addresses do not carry balances...but all info suggests otherwise
    Why Can't I shrink log file in full recovery mode
    Why const members can be modified in constructor?
    What effects would propellant that expands at near light speed have on firearm technology?
    Making a strong belgian ale
    echo "hello" >&0 | > file.txt doesn't write to file.txt
    RSA: What would happen if you chose n to be a prime?
    Shell script to skip PPA if installed
    Player character wants a gun in a prehistoric campaign. What to do?
    Why is Curiosity not heading for Peace Vallis?
    Can Mage Hand be opaque?
    Why did the Soviet Union name their strongest bomb Tsar Bomba?
    In a planetary system close to the galactic core, would it be possible to see the supermassive black hole?
    STACK OVERFLOW
    Questions
    Jobs
    Developer Jobs Directory
    Salary Calculator
    Help
    Mobile
    STACK OVERFLOW
    BUSINESS
    Talent
    Ads
    Enterprise
    COMPANY
    About
    Press
    Work Here
    Legal
    Privacy Policy
    Contact Us
    STACK EXCHANGE
    NETWORK
    Technology
    Life / Arts
    Culture / Recreation
    Science
    Other
    Blog
    Facebook
    Twitter
    LinkedIn
    site design / logo © 2018 Stack Exchange Inc; user contributions licensed under cc by-sa 3.0 with attribution required. rev 2018.3.28.29625


<?php
include 'Includes/footer.php';