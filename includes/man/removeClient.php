<style>
    body {
        margin: 15px;
    }

    tr th {
        padding: 0px 5px !important;
        text-align: center;
    }

    tr td {
        width: auto;
        text-align: center;
        padding: 0px 5px;
    }

    .options:hover {
        cursor: pointer;

    }

    #legend {
        color: floralwhite;
    }

    .sr #no-search #no-search-text.sm {
        display: none;
    }

    .container-img {
        border: 1px solid #dddddd;
        border-radius: 5px;
        height: 100px;
        width: 100%;
        font-family: Roboto, sans-serif;
        display: flex;
        flex-direction: row;
        align-items: center;
        /* justify-content: space-around; */
    }

    .data {
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex-wrap: nowrap;
        width: calc(100% - 5rem);
        align-items: baseline;
        height: 100%;
        margin-left: 1rem;
    }

    .pic {
        border-radius: 10px;
        background-color: #cccccc;
        width: 2em;
        height: 2em;
        display: flex;
        /* padding-right: 20px; */
        margin: 1rem .5rem 1rem .5rem;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #ffffff;
        box-shadow: 0px 0px 6px rgba(20, 20, 20, 0.6);
    }

    .name {
        color: #222222;
    }

    @media (min-width: 320px) {
        .sr {
            width: 100% !important;
            margin-top: 3rem;
        }

        .sr #no-search {
            left: 15% !important;
            width: 100% !important;
            top: 22% !important;
        }
    }

    @media (min-width: 480px) {
        .sr #no-search {
            left: 25% !important;
            width: 100% !important;
            top: 22% !important;
        }
    }

    @media (max-width: 500px) {
        .sr #no-search #no-search-text {
            display: none !important;
        }

        .sr #no-search #no-search-text.sm {
            display: inline-block !important;
        }
    }

    @media (min-width: 500px) {
        body {
            margin: 7px !important;
        }

        .sr {
            width: 100% !important;
            margin-top: 1.25rem !important;
        }

        .sr #no-search {
            left: 25% !important;
            width: max-content !important;
        }

        .sr #no-search #no-search-text {
            display: block !important;
        }

        .sr #no-search #no-search-text.sm {
            display: none !important;
        }

        #tendet>#search {
            margin-right: 0% !important;
        }
    }

    .nm {
        display: flex;
        flex-direction: column;
        margin-bottom: 5px;
        width: calc(100% - 2em);
    }

    .nm .name {
        padding: .2rem;
        border-radius: 5px;
        color: aquamarine;
    }

    .other {
        flex-direction: column !important;
        justify-content: space-evenly !important;
        height: max-content !important;
    }

    .data.other .nm {
        width: 100% !important;
    }

    .sr {
        max-height: max-content !important;
        min-height: 271px !important;
    }

    #search-ret {
        max-height: 100% !important;
        min-height: min-content !important;
    }

    .lbl {
        color: #dddddd;
        width: max-content;
    }

    .container-img {
        margin-bottom: .8em;
    }

    #search-ret#row:last-child {
        margin-bottom: .6rem !important;
    }

    .hint-data {
        text-align: left;
    }
</style>
<div id="search" class="align-self-center" style="width: 100%;border: 0px grey solid; padding: 0px 10px; border-radius: 7px; transition: all 0.5s ease 0.5s;">
    <div style="background-color: #8a2be2; top: -12px; left: 10px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
        <span id="legend" style="background-color: grey; padding: 3px; border-radius: 10px; color:floralwhite">Tenant Search</span>
    </div>
    <form action="" method="get" id="search" enctype="multipart/form-data" style="display:none">
        <input type="checkbox" name="search_type" id="st" hidden="hidden" aria-hidden="true" value="getAll">
        <span onclick="check(this)" class="options"><input type="radio" name="type" id="ten_name">&nbsp;Tenant Name </span></br>
        <span onclick="check(this)" class="options"><input type="radio" name="type" id="ten_nin">&nbsp;Tenant NIN </span><br>
        <span onclick="check(this)" class="options"><input type="radio" name="type" id="house_num">&nbsp;House Number</span><br>
        <span id="error_sms" style="display:none"></span>
        <div class="field-wrapper">
            <input type="search" name="search" id="search-field" class="form-control input-lg s-f" autocomplete="false" autocapitalize="false" tabindex="50">
            <div class="field-placeholder">
                <span>Enter Search Criteria: </span>
            </div>
        </div>
        <div style="width: 50%; display:none">
            <div style="background-color: #8a2be2; top: -8px; left: 10px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
                <span id="legend" style="background-color: transparent; padding: 3px; border-radius: 10px; color:floralwhite">Search Hints</span>
            </div>
            <div class="search-hint" style="margin-left: 3rem">
            </div>
        </div>
        <div class="field-wrapper" hidden="hidden" style="display:none">
            <input type="text" name="ver" id="ver" class="form-control input-lg" value="Zm9ydGhlbG92ZW9mdG1zKGMpcGxlYXNlZG9ub3R1c2VzdHlsaW5nc2Vsc2V3aGVyZQ==" aria-hidden="hidden">
            <div class="field-placeholder">
                <span>Verifier in Jarvaang Encoder</span>
            </div>
        </div>
        <button type="submit" class="tms-button tms-search tms-section tms-block">Search Tenant</button>
    </form>
</div>
<div id="search" class="align-self-center sr" style="margin-top: 1.25rem; width: 100%;border: 0px grey solid; padding: 0px 10px; border-radius: 7px; transition: all 0.5s ease 0.5s;">
    <div style="background-color: #8a2be2; top: -10px; left: 10px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
        <span id="legend" style="background-color: grey; padding: 3px; border-radius: 10px; color:floralwhite">Search Results</span>
    </div>
    <div id="no-search" class="align-self-center border-1" style="width: max-content; display: inline-block; top: 50%; left: 37%; position: relative">
        <span id="no-search-text" class="alert alert-info">Please carry out a search in the top panel.</span>
    </div>
    <div id="search-ret" class="align-self-center border-1" style="width: 100%; height:fit-content; overflow-wrap:break-word; display: none; position: relative">
        <div class="container-img">
            <img class="pic" src="/images/img_avatar2.png" />
            <div class="data" style="position: relative; top: 0">
                <div class="nm" style="position: relative; top: 0">
                    <span class="lbl">First Name: </span>
                    <div class="name" id="name" style="background-color: grey">Dummy Name</div>
                </div>
            </div>
        </div>
        <div class="container-img other">
            <div style="background-color: #8a2be2; top: -12px; left: -70px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
                <span id="legend" style="background-color: grey; padding: 3px; border-radius: 10px; color:floralwhite">House Details</span>
            </div>
            <div class="data other col-sm-12 col-md-12 col-lg-6" style="top: -10px; margin-left: -20px;">
                <div class="nm">
                    <span class="lbl">House Number: </span>
                    <div class="name" id="hn" style="background-color: grey">Dummy Name</div>
                </div>
                <div class="nm">
                    <span class="lbl">House Location: </span>
                    <div class="name" id="hl" style="background-color: grey">Dummy Name</div>
                </div>
            </div>
            <div class="data other col-sm-12 col-md-12 col-lg-6" style="top: -10px; margin-left: -20px;">
                <div class="nm">
                    <span class="lbl">Amount Per Month: </span>
                    <div class="name" id="apm" style="background-color: grey">Dummy Name</div>
                </div>
            </div>
        </div>
        <div class="container-img other">
            <div>
                <input type="checkbox" name="remTen" id="rT">
                Mark tenant as left
            </div>
            <button type="reset" name="reset" id="reset" hidden>Reset</button>
        </div>
    </div>
</div>
<script src="//cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js"></script>
<script src="//cdn.tms-dist.lan:433/styles/js/client.min.js"></script>

<script>
    $('#rT').on('change', _ => {
        $('#ajax_overlay').css({
            'display': 'block',
            'z-index': 99999,
            'height': 100 + '%'
        })
        $('#ajax_loading_box').css({
            'display': 'block',
            'z-index': 99999,
        })
        if (_.target.checked)
            var conf = confirm('Has the tenant really left?')
        if (conf) {
            console.log('Tenant marked for leaving ...')
            var data = remTenant(window.nin)
            window.win = data;
            setTimeout(_ => {
                if (win.msg['status'] == 'OK') {
                    $('#ajax_overlay').css({
                        'display': 'none',
                        'z-index': 'unset',
                        'height': 'unset'
                    })
                    $('#ajax_loading_box').css({
                        'display': 'none',
                        'z-index': 'unset',
                    })
                    $('#reset').click()
                    $('#search-field').val('')
                    document.getElementById('search-field').value = ''
                    $('#search-field').focus()
                    console.log(win.msg['msg'])
                }
            }, 3000)
        } else {
            _.target.checked = false;
            $('#ajax_overlay').css({
                'display': 'none',
                'z-index': 'unset',
                'height': 'unset'
            })
            $('#ajax_loading_box').css({
                'display': 'none',
                'z-index': 'unset',
            })
        }
    })
    $('span#legend').on('click', _ => {
        $('div#search').css({
            width: '100%',
            minHeight: 50 + 'px',
            border: '1px grey solid',
        })
        $('form#search').css({
            'display': 'block',
            width: 100 + '%'
        })
        $('span#legend').removeAttr('style')
    })
    $('span#legend').click()
    $(function() {
        $(".field-wrapper .field-placeholder").on("click", function() {
            $(this).closest(".field-wrapper").find("input").focus();
        });
        $(".field-wrapper input").on("keyup", function() {
            var value = $.trim($(this).val());
            if (value) {
                $(this).closest(".field-wrapper").addClass("hasValue");
            } else {
                $(this).closest(".field-wrapper").removeClass("hasValue");
            }
        });
    });
</script>