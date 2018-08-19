<html>
<head>
    <title>JSON CONVERTER</title>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TN5NZHV');</script>
    <!-- End Google Tag Manager -->

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TN5NZHV"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="card" style="display: block; padding: 10% 0;">
    <div class="card-content " style=" border: 2px solid #111d57; max-width: 786px; margin: 0 auto; border-radius: 7px; padding: 0 25px;">
        <h2 class="card-title">CONVERT YOUR GSTR 2A TO EXCEL FILES EASILY</h2>
        <div style="color: grey;">
            <h4>How to convert GSTR 2A to .EXCEL</h4>
            <p>1. Upload your GSTR 2A .JSON file.</p>
            <p>2. Press the CONVERT button below to start the conversion.</p>
            <p>3. Excel file automatically Downloads on your local device.</p>
            <p>4. Open your Excel file. It is useful to view the data in a spreadsheet such as Excel or Open Office.
            </p>
        </div>
        <div >

            <form action="{{url('/converter')}}" method="post" id="convert_form" enctype="multipart/form-data">

                <input class="text-center" type="file" id="jsonFile" name="jsonFile" style="margin: 1% 25% 0 29%;" />

                <div >
                    <input class="btn btn-md btn-primary" type="submit" value="Convert to EXCEL" id="apply" style="background-color: green;
                    width: 20%; font-weight: bold; color: white; margin: 2% 25% 0 29%;" />
                </div>
            </form>
        </div>


    </div>

    <div>
        <p style="padding: 0 68%"><a href="mailto:support@kloudportal.com" class="">contactus@kloudportal.com</a></p>

    </div>


</div>
</body>
</html>