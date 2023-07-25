<!DOCTYPE html>
<link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/bootstrap.min.css">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400">
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

    #sr #no-search #no-search-text.sm {
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
        justify-content: end;
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
        #sr {
            width: 100% !important;
            margin-top: 3rem;
        }

        #sr #no-search {
            left: 15% !important;
            width: 80% !important;
            top: 22% !important;
        }
    }

    @media (min-width: 480px) {
        #sr #no-search {
            left: 27% !important;
            width: 80% !important;
            top: 22% !important;
        }

        #tendet > #search {
            margin-right: 22% !important;
        }
    }

    @media (max-width: 500px) {
        #sr #no-search #no-search-text {
            display: none !important;
        }

        #sr #no-search #no-search-text.sm {
            display: inline-block !important;
        }
    }

    @media (min-width: 500px) {
        body {
            margin: 7px !important;
        }

        #sr {
            width: 75% !important;
            margin-top: 0 !important;
        }

        #sr #no-search {
            left: 37% !important;
            width: max-content !important;
        }

        #sr #no-search #no-search-text {
            display: block !important;
        }

        #sr #no-search #no-search-text.sm {
            display: none !important;
        }

        #tendet > #search {
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

    #sr {
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

    .sr_edit-ten {
        float: right;
        position: relative;
        z-index: 2;
        right: 0;
        margin-top: -20px;
        padding: .75em;
    }

    .update_ten:hover {
        background-color: rgba(173, 255, 47, 0.7) !important;
    }
</style>
<script>
    window.passStrike = window.passStrike || 0;

    // const btob = 'fortheloveoftms(c)pleasedonotusestylingselsewhere'
    function check(e) {
        e.firstChild.checked = true
        // document.getElementById('search-ret').style.display = 'none'
        $('#search-ret').hide()
    }

    $('#search').on('click', _ => {
        $('#error_sms').removeClass('alert alert-danger').hide()
        $('#no-search').show()
        $('#search-ret').hide()
        $('.search-hint').parent().css({
            display: 'none'
        })
    })
    $('#search[name="form_search"]').on('submit', (e) => {
        e.preventDefault()
        loader(true)
        let type;
        for (let index = 2; index < 6; index++) {
            type = e.target[index].checked === true ? e.target[index] : null
            type != null ? index = 6 : null
        }
        let msg = (type == null ? 'Type not specified please click one' : 'Continue')
        if (msg != 'Continue') {
            $('#error_sms').addClass('alert alert-danger').show()
            document.getElementById('error_sms').innerText = msg
            $('#ajax_overlay').css({
                display: 'none'
            })
            $('#ajax_loading_box').css({
                display: 'none'
            })
            return
        } else {
            searchparams = $('#search-field').val()
            if (searchparams.trim() == '') {
                $('#error_sms').addClass('alert alert-danger').show()
                document.getElementById('error_sms').innerText = 'Please specify a search parameter!'
                $('#ajax_overlay').css({
                    display: 'none'
                })
                $('#ajax_loading_box').css({
                    display: 'none'
                })
                return
            }
            $.ajax({
                url: '/actions/gtd.php',
                data: {
                    'sp': btoa(searchparams),
                    't': btoa(type.attributes['id'].nodeValue),
                    'ver': $('#ver').val()
                },
                dataType: 'json',
                method: 'POST',
                success: e => {
                    // log(e)
                    if (e.err != undefined) {
                        $('#no-search-text').removeClass('alert-info').addClass('alert-danger')
                        $('#no-search-text').html('<span class="glyphicon glyphicon-help"></span>' + e.err)
                        document.getElementsByClassName('sm')[1].style = "display: none !important;"
                        $('#no-search-text.sm').removeClass('alert-info').addClass('alert-danger')
                        $('#no-search-text.sm').html('<span class="glyphicon glyphicon-help"></span>' + e.err)
                        $('#ajax_overlay').css({
                            display: 'none'
                        })
                        $('#ajax_loading_box').css({
                            display: 'none'
                        })
                    } else {
                        $('#ajax_overlay').css({
                            display: 'none'
                        })
                        $('#ajax_loading_box').css({
                            display: 'none'
                        })
                        if (e._teninfo != null) {
                            $('#no-search').hide()
                            $('#search-ret').show()
                            $('.pic').attr('src', e._teninfo.img)
                            $('#fn.name').text(e._teninfo.fn)
                            $('#ln.name').text(e._teninfo.fl)
                            $('#nin.name').text(e._teninfo.nin)
                            $('#mno.name').text(e._teninfo.cont_mobile)
                            $('#hnum.name').text(e._teninfo.cont_home == "" ? 'No Second Number' : e._teninfo.cont_home)
                            $('#email.name').text(e._teninfo.email == null ? 'No Email' : e._teninfo.email)
                            if (e._teninfo.h_no != null) {
                                $('.update_ten').css({
                                    display: 'block'
                                })
                                let houseData = $('#search-ret').children(':nth-child(3)')
                                let nSD = $('#search-ret').children(':nth-child(4)')
                                houseData.children(':not(:first-child)').css({
                                    display: 'block',
                                })
                                houseData.children('.alert').css({
                                    display: 'none'
                                })
                                nSD.children(':not(:first-child)').css({
                                    display: 'block'
                                })
                                nSD.children('.alert').css({
                                    display: 'none'
                                })
                                $('#hn.name').text(e._teninfo.h_no)
                                $('#hl.name').text(e._teninfo.h_loc)
                                $('#apm.name').text(e._teninfo.apm)
                                $('#wmn.name').text(e._teninfo.water_m)
                                $('#wcm.name').text(e._teninfo.water_c)
                                $('#umeme.name').text(e._teninfo.yaka)
                            } else {
                                $('.update_ten').css({
                                    display: 'none'
                                })
                                let houseData = $('#search-ret').children(':nth-child(3)')
                                let nSD = $('#search-ret').children(':nth-child(4)')
                                houseData.children(':not(:first-child)').css({
                                    display: 'none',
                                })
                                nSD.children(':not(:first-child)').css({
                                    display: 'none'
                                })
                                let error = document.createElement('div');
                                $(error).addClass('alert alert-info')
                                error.appendChild(document.createTextNode('Tenant left the premises'))
                                houseData.get(0).appendChild(error)
                                let error1 = document.createElement('div');
                                $(error1).addClass('alert alert-info')
                                error1.appendChild(document.createTextNode('Tenant left the premises'))
                                nSD.get(0).appendChild(error1)
                            }
                            if (e._info.includes('Water Customer Number')) {
                                $('#wcm.name').css({
                                    'color': 'red'
                                })
                            } else if (e._info.includes('Tenant Name')) {
                                $('#fn.name').css({
                                    'color': 'red'
                                })
                                $('#ln.name').css({
                                    'color': 'red'
                                })
                            } else if (e._info.includes('National ID')) {
                                $('#nin.name').css({
                                    'color': 'red'
                                })
                            } else if (e._info.includes('YAKA')) {
                                $('#umeme.name').css({
                                    'color': 'red'
                                })
                            }
                        }
                    }
                },
                error: e => {
                    $('#ajax_overlay').css({
                        display: 'none'
                    })
                    $('#ajax_loading_box').css({
                        display: 'none'
                    })
                    log(e.responseText)
                },
            })
        }
    })
    $('.s-f').on('keyup', _ => {
        let sf = _.target.value
        let type;
        for (let index = 2; index < 6; index++) {
            type = $(_.target).parent().parent()[0][index].checked == true ? $(_.target).parent().parent()[0][index] : null
            type != null ? index = 6 : index = index
        }
        if ($(_.target).parent().hasClass('hasValue')) {
            let html = '<table style="width: 100%; "><tbody>';
            if (sf != '' && (sf.length >= 2))
                $.ajax({
                    url: '/ghint',
                    data: {
                        'sp': btoa(sf),
                        't': btoa(type.attributes['id'].nodeValue),
                        'ver': $('#ver').val()
                    },
                    dataType: 'json',
                    method: 'POST',
                    success: e => {
                        if (e.err != undefined) {
                            $('.search-hint').parent().css({
                                display: 'block'
                            })
                            $('.search-hint').html('').addClass('alert alert-danger')
                            let sh = document.createTextNode(e.err)
                            $('.search-hint')[0].appendChild(sh)
                        } else {
                            $('.search-hint').parent().css({
                                display: 'block'
                            })
                            if (!$('.search-hint').hasClass('alert')) $('.search-hint').addClass('alert')
                            $('.search-hint').html('').removeClass('alert-danger').addClass('alert-info')
                            let ti = 50;
                            if (e.status == 200) {
                                for (const key in e.hints) {
                                    if (e.hints.hasOwnProperty(key)) {
                                        const hint = e.hints[key]
                                        html = html.concat('<tr data-input-update-id="search-field" data-input-update-data=":nth-child(2)" class="hint-data" tabindex=', ++ti, ' style="cursor: pointer; border-bottom: 1.5px solid black!important;border-top: 1.5px solid black!important;">')
                                        html = html.concat('<td style="padding-top: 0.3rem !important; padding-bottom: 0.3rem !important;">'.concat(parseInt(key.split('_')[1]) + 1).concat('</td>'))
                                        html = html.concat('<td style="padding-top: 0.3rem !important; padding-bottom: 0.3rem !important; text-align: left;">'.concat(hint['names']['fName'].concat(' ').concat(hint['names']['lName'])).concat('</td>'))
                                        html = html.concat('</tr>')
                                    }
                                }
                                html = html.concat('</tbody></table>');
                                $('.search-hint').html(html)
                                let body = document.getElementsByTagName('body')[0]
                                let script = document.createElement('script')
                                $(script).text('$(".hint-data").on("click", _ => update(_))')
                                body.appendChild(script)
                            }
                        }
                    },
                    error: e => {
                        log(e.responseText)
                    },
                })
        } else
            $('.search-hint').parent().css({
                display: 'none'
            })
    })
    search = _ => {

    }
    update = _ => {
        let f = _.delegateTarget
        let upd_field, upd_data;
        upd_field = '#'.concat(f.dataset['inputUpdateId'])
        upd_data = f.dataset['inputUpdateData']
        log($(f).children(upd_data)[0].textContent)
        $(upd_field).val($(f).children(upd_data)[0].textContent)
    }
    if (undefined === typeof edit) {
        const edit = new Object({
            0: 'fN',
            1: 'lN',
            2: 'NIN',
            3: 'mNo',
            4: 'hNum',
            5: 'Email'
        })
    }
    if (undefined === typeof prev_values) {
        let prev_values = {};
    }
    let edit_order = []

    let eo = function (k) {
        switch (k) {
            case 0: {
                return k + ': First Name'
            }
            case 1: {
                return k + ': Last Name'
            }
            case 2: {
                return k + ': National Id Number'
            }
            case 3: {
                return k + ': Mobile Number'
            }
            case 4: {
                return k + ': Home Number'
            }
            case 5: {
                return k + ': Email'
            }
            case 6: {
                return k + ': Water Meter Number'
            }
            case 7: {
                return k + ': Water Customer Number'
            }
            case 8: {
                return k + ': Yaka'
            }
            default:
                break;
        }
    }
    let pe = function (event) {
        let edit_pwd = 'pr0ce553d17';
        let password = prompt('Please provide the data edit password?')
        window.passStrike += 1
        if (password !== "" || password !== null) {
            let data = [];
            if (atob(password) == atob(edit_pwd)) {
                edit_order.forEach(e_o => {
                    data.push(parseInt(e_o.toString().split(':')[0]))
                });
                let ajaxData = Object()
                for (const key in edit) {
                    if (edit.hasOwnProperty(key)) {
                        const field = edit[key];
                        data.forEach(index => {
                            if (parseInt(key) == index) {
                                const fieldId = '#' + field;
                                if ($(fieldId).get(0).checked) {
                                    $(fieldId.toLowerCase()).attr('contenteditable', 'false')
                                    for (const key in prev_values) {
                                        if (prev_values.hasOwnProperty(key)) {
                                            const value = prev_values[key];
                                            if ($(('#' + edit[key]).toLowerCase()).text().toLowerCase().trim() != value.toString().toLowerCase().trim()) {
                                                ajaxData[fieldId.toString().split('#')[1]] = $(fieldId.toLowerCase()).text().trim();
                                                break
                                            } else continue
                                        }
                                    }
                                }
                            }
                        });
                    }
                }
                ajaxData['cNIN'] = prev_values[2];
                ajaxData['end'] = undefined;
                $.ajax({
                    url: '/api/update',
                    type: 'UPDATE',
                    dataType: 'json',
                    contentType: 'application/json',
                    traditional: true,
                    data: ajaxData,
                    success: (_) => {
                        log(_)
                    },
                    error: (_) => {
                        log('Error')
                    }
                })
                // log(data)
                // log(edittedFields)
                // log(prev_values)
                $('[class*="update_ten"]').text('Update Tenant Data')
                $('[class*="update_ten"]').attr('data-btn-action', 'update_ten')
            } else {
                if (window.passStrike < 4) {
                    alert('Wrong password! Try Again;\n\t\t\tStrike: '.concat(window.passStrike).concat(' of 3'))
                    pe(event)
                } else {
                    alert('Contact admin for edit Password!')
                    window.location.href = window.location.href.replace(location.pathname, '/actions/logout.php')
                }
            }
        }
    }
    $('[class*="update_ten"]').on('click', function () {
        if ($(this).attr('data-btn-action') == 'update_ten')
            $("#edit_ten_dialog").dialog({
                title: 'Select the fields to be editted!',
                closeOnEscape: true,
                minHeight: 320,
                minWidth: 200,
                modal: true,
                close: function (event, ui) {
                    loader()
                    if (edit_order.length)
                        setTimeout(() => {
                            $('[class*="update_ten"]').text('Process Edits')
                            $('[class*="update_ten"]').attr('data-btn-action', 'process_update_ten')
                        }, 2000)
                },
                create: function (event, ui) {
                    for (const key in edit) {
                        if (edit.hasOwnProperty(key)) {
                            const fieldId = '#' + edit[key];
                            prev_values[key] = $(fieldId.toLowerCase()).text();
                        }
                    }
                },
                position: {
                    my: 'center center',
                    at: 'center center',
                    of: "#edit_ten"
                },
                buttons: [{
                    text: "Edit Fields",
                    icon: "ui-icon-circle-plus",
                    click: function () {
                        edit_order = []
                        for (const key in edit) {
                            if (edit.hasOwnProperty(key)) {
                                const fieldId = '#' + edit[key];
                                if ($(fieldId).get(0).checked) {
                                    $(fieldId.toLowerCase()).attr('contenteditable', 'true')
                                    edit_order.push(eo(parseInt(key)))
                                }
                            }
                        }
                        if (edit_order.length)
                            confirm('Please edit in the order: \n\t' + edit_order.join(',\n\t')) ?
                                $(this).dialog("close") : null
                        else $(this).dialog("close")
                    }
                }]
            })
        else if ($(this).attr('data-btn-action') == 'process_update_ten') {
            pe(this)
        }
    })

    $('.update_ten').css({
        display: 'none'
    })
    let query = window.location.search.split('?')[1]
    let findStr = ''
    if (query != null) {
        findStr = query.split('=')[1]
        $('#search-field').get(0).value = findStr
        switch (query.split('=')[0]) {
            case 'nin':
                $('#ten_nin').click()
                $('#search-field').focus()
                loader(true)
                setTimeout(() => {
                    $.ajax({
                        url: '/actions/gtd.php',
                        data: {
                            'sp': btoa(findStr),
                            't': btoa('ten_nin'),
                            'ver': $('#ver').val()
                        },
                        dataType: 'json',
                        method: 'POST',
                        success: e => {
                            // log(e)
                            if (e.err != undefined) {
                                $('#no-search-text').removeClass('alert-info').addClass('alert-danger')
                                $('#no-search-text').html('<span class="glyphicon glyphicon-help"></span>' + e.err)
                                document.getElementsByClassName('sm')[1].style = "display: none !important;"
                                $('#no-search-text.sm').removeClass('alert-info').addClass('alert-danger')
                                $('#no-search-text.sm').html('<span class="glyphicon glyphicon-help"></span>' + e.err)
                            } else {
                                if (e._teninfo != null) {
                                    $('#no-search').hide()
                                    $('#search-ret').show()
                                    $('.pic').attr('src', e._teninfo.img)
                                    $('#fn.name').text(e._teninfo.fn)
                                    $('#ln.name').text(e._teninfo.fl)
                                    $('#nin.name').text(e._teninfo.nin)
                                    $('#mno.name').text(e._teninfo.cont_mobile == "" ? 'Not Provided' : e._teninfo.cont_mobile)
                                    $('#hnum.name').text(e._teninfo.cont_home == null || e._teninfo.cont_home == "" ? 'No Second Number' : e._teninfo.cont_home)
                                    $('#email.name').text(e._teninfo.email == null ? 'No Email' : e._teninfo.email)
                                    if (e._teninfo.h_no != null) {
                                        $('.update_ten').css({
                                            display: 'block'
                                        })
                                        let houseData = $('#search-ret').children(':nth-child(3)')
                                        let nSD = $('#search-ret').children(':nth-child(4)')
                                        houseData.children(':not(:first-child)').css({
                                            display: 'block',
                                        })
                                        houseData.children('.alert').css({
                                            display: 'none'
                                        })
                                        nSD.children(':not(:first-child)').css({
                                            display: 'block'
                                        })
                                        nSD.children('.alert').css({
                                            display: 'none'
                                        })
                                        $('#hn.name').text(e._teninfo.h_no)
                                        $('#hl.name').text(e._teninfo.h_loc)
                                        $('#apm.name').text(e._teninfo.apm)
                                        $('#wmn.name').text(e._teninfo.water_m)
                                        $('#wcm.name').text(e._teninfo.water_c)
                                        $('#umeme.name').text(e._teninfo.yaka)
                                    }
                            else {
                                        $('.update_ten').css({
                                            display: 'none'
                                        })
                                        let houseData = $('#search-ret').children(':nth-child(3)')
                                        let nSD = $('#search-ret').children(':nth-child(4)')
                                        houseData.children(':not(:first-child)').css({
                                            display: 'none',
                                        })
                                        nSD.children(':not(:first-child)').css({
                                            display: 'none'
                                        })
                                        let error = document.createElement('div');
                                        $(error).addClass('alert alert-info')
                                        error.appendChild(document.createTextNode('Tenant left the premises'))
                                        houseData.get(0).appendChild(error)
                                        let error1 = document.createElement('div');
                                        $(error1).addClass('alert alert-info')
                                        error1.appendChild(document.createTextNode('Tenant left the premises'))
                                        nSD.get(0).appendChild(error1)
                                    }
                                    if (e._info.includes('Water Customer Number')) {
                                        $('#wcm.name').css({
                                            'color': 'red'
                                        })
                                    } else if (e._info.includes('Tenant Name')) {
                                        $('#fn.name').css({
                                            'color': 'red'
                                        })
                                        $('#ln.name').css({
                                            'color': 'red'
                                        })
                                    } else if (e._info.includes('National ID')) {
                                        $('#nin.name').css({
                                            'color': 'red'
                                        })
                                    } else if (e._info.includes('YAKA')) {
                                        $('#umeme.name').css({
                                            'color': 'red'
                                        })
                                    }
                                }
                            }
                            loader()
                        },
                        error: e => {
                            loader()
                            log(e.responseText)
                        },
                        finally: e => {
                            loader()
                        }
                    })
                }, 500)
        }
    }
</script>

<body id="body">
<div id="search" class="align-self-center"
     style="float: right; width: 25%;border: 0px grey solid; padding: 0px 10px; border-radius: 7px; transition: all 0.5s ease 0.5s;">
    <div style="background-color: #8a2be2; top: -12px; left: 10px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
        <span id="legend" style="background-color: grey; padding: 3px; border-radius: 10px; color:floralwhite">Tenant Search</span>
    </div>
    <form action="" name="form_search" method="get" id="search" enctype="multipart/form-data" style="float: right; display:none">
        <span id="error_sms" style="display:none"></span>
        <div class="field-wrapper">
            <input type="search" name="search" id="search-field" class="s-f form-control input-lg" autocomplete='false'>
            <div class="field-placeholder">
                <span>Enter Search Criteria: </span>
            </div>
        </div>
        <div style="width: 100%; display:none">
            <div style="background-color: #8a2be2; top: -8px; left: 10px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
                <span id="legend"
                      style="background-color: transparent; padding: 3px; border-radius: 10px; color:floralwhite">Search Hints</span>
            </div>
            <div class="search-hint" style="margin-left: 3rem">
            </div>
        </div>
        <div class="field-wrapper" hidden="hidden" style="display:none">
            <input type="text" name="ver" id="ver" class="form-control input-lg"
                   value="Zm9ydGhlbG92ZW9mdG1zKGMpcGxlYXNlZG9ub3R1c2VzdHlsaW5nc2Vsc2V3aGVyZQ==" aria-hidden="hidden">
            <div class="field-placeholder">
                <span>Enter Search Criteria: </span>
            </div>
        </div>
        <span onclick="check(this)" class="options">
            <input type="radio" name="type" id="ten_name">&nbsp;Tenant Name </span>
        <br/>
        <span onclick="check(this)" class="options">
            <input type="radio" name="type" id="cust_no">&nbsp;Water Customer Number
        </span>
        <br/>
        <span onclick="check(this)" class="options">
            <input type="radio" name="type" id="ten_nin">&nbsp;Tenant NIN
        </span>
        <br/>
        <span onclick="check(this)" class="options">
            <input type="radio" name="type" id="yaka_no">&nbsp;YAKA Number
        </span>
        <br/>
        <button id="search_submit_btn" type="submit" class="tms-button tms-search tms-section tms-block">Search Tenant</button>
    </form>
</div>
<div id="sr"
     style="float:left; width: 75%;border: 1px grey solid; padding: 0px 10px; border-radius: 7px; transition: all 0.5s ease 0.5s; height:max-content">
    <div style="background-color: #8a2be2; top: -12px; left: 10px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
        <span id="legend" style="background-color: grey; padding: 3px; border-radius: 10px; color:floralwhite">Tenant Search Results</span>
    </div>
    <div id="edit_ten" class="sr_edit-ten">
        <button class="tms-button tms-search tms-section tms-block update_ten" data-btn-action="update_ten"
                type="submit" style="background-color: greenyellow; border-radius: 10px">Update Tenant Data
        </button>
    </div>
    <div id="no-search" class="align-self-center border-1"
         style="width: max-content; display: inline-block; top: 50%; left: 37%; position: relative">
        <span id="no-search-text" class="alert alert-info">Please carry out a search in the right panel.</span>
        <span id="no-search-text" class="alert alert-info sm">Please carry out a search</span>
        <span id="no-search-text" class="one alert alert-info sm align-self-center" style="margin-left: 2.5rem">in the top panel.</span>
    </div>
    <div id="search-ret" class="align-self-center border-1"
         style="width: 100%; height:fit-content; overflow-wrap:break-word; display: none; position: relative">
        <div class="container-img">
            <img class="pic" src="/images/img_avatar2.png"/>
            <div class="data">
                <div class="nm">
                    <span class="lbl">First Name: </span>
                    <div class="name" id="fn" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
                <div class="nm">
                    <span class="lbl">Last Name: </span>
                    <div class="name" id="ln" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
            </div>
        </div>
        <div class="container-img other">
            <div style="background-color: #8a2be2; top: -12px; left: -65px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
                <span id="legend" style="background-color: grey; padding: 3px; border-radius: 10px; color:floralwhite">Contact Details</span>
            </div>
            <div class="data other col-sm-12 col-md-12 col-lg-6" style="top: -10px; margin-left: -20px;">
                <div class="nm">
                    <span class="lbl">National ID Number: </span>
                    <div class="name" id="nin" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
                <div class="nm">
                    <span class="lbl">Mobile Number: </span>
                    <div class="name" id="mno" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
                <div class="nm">
                    <span class="lbl">Home Number: </span>
                    <div class="name" id="hnum" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
            </div>
            <div class="data other col-sm-12 col-md-12 col-lg-6" style="top: -10px; margin-left: -20px;">
                <div class="nm">
                    <span class="lbl">Email: </span>
                    <div class="name" id="email" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
            </div>
        </div>
        <div class="container-img other" aria-disabled="disabled">
            <div style="background-color: #8a2be2; top: -12px; left: -70px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
                <span id="legend" style="background-color: grey; padding: 3px; border-radius: 10px; color:floralwhite">House Details</span>
            </div>
            <div class="data other col-sm-12 col-md-12 col-lg-6" style="top: -10px; margin-left: -20px;">
                <div class="nm">
                    <span class="lbl">House Number: </span>
                    <div class="name" id="hn" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
                <div class="nm">
                    <span class="lbl">House Location: </span>
                    <div class="name" id="hl" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
            </div>
            <div class="data other col-sm-12 col-md-12 col-lg-6" style="top: -10px; margin-left: -20px;">
                <div class="nm">
                    <span class="lbl">Amount Per Month: </span>
                    <div class="name" id="apm" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
            </div>
        </div>
        <div class="container-img other">
            <div style="background-color: #8a2be2; top: -12px; left: -30px; padding: 2px 5px; width: max-content; position: relative; cursor: default">
                <span id="legend" style="background-color: grey; padding: 3px; border-radius: 10px; color:floralwhite">National Service Details</span>
            </div>
            <div class="data other col-sm-12 col-md-12 col-lg-6" style="top: -10px; margin-left: -20px;">
                <div class="nm">
                    <span class="lbl">Water Meter Number: </span>
                    <div class="name" id="wmn" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
                <div class="nm">
                    <span class="lbl">Water Customer Number:</span>
                    <div class="name" id="wcm" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
            </div>
            <div class="data other col-sm-12 col-md-12 col-lg-6" style="top: -10px; margin-left: -20px;">
                <div class="nm">
                    <span class="lbl">Yaka: </span>
                    <div class="name" id="umeme" style="background-color: grey" contenteditable="false">Dummy Name</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="edit_ten_dialog" style="display: none">
    <div class="dialog-body">
        <div class="row" style="padding: 0px">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul style="list-style:none; display: flexbox; flex-direction: column">
                    <li><input type="checkbox" name="edit" id="fN">&MediumSpace;First Name</li>
                    <li><input type="checkbox" name="edit" id="lN">&MediumSpace;Last Name</li>
                    <li><input type="checkbox" name="edit" id="NIN">&MediumSpace;NIN</li>
                    <li><input type="checkbox" name="edit" id="mNo">&MediumSpace;Mobile Number</li>
                    <li><input type="checkbox" name="edit" id="hNum">&MediumSpace;Home Number</li>
                    <li><input type="checkbox" name="edit" id="Email">&MediumSpace;Email Address</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $('span#legend').on('click', _ => {
        $('div#search').css({
            'width': 'max-content',
            'border': '1px grey solid',
        })
        $('form#search').css({
            'display': 'block'
        })
        $('span#legend').removeAttr('style')
    })
    $('span#legend').click()
    $(function () {
        $(".field-wrapper .field-placeholder").on("click", function () {
            $(this).closest(".field-wrapper").find("input").focus();
        });
        $(".field-wrapper input").on("keyup", function () {
            let value = $.trim($(this).val());
            if (value) {
                $(this).closest(".field-wrapper").addClass("hasValue");
            } else {
                $(this).closest(".field-wrapper").removeClass("hasValue");
            }
        });
    });
</script>
<script>
    $.getScript('//cdn.tms-dist.lan:433/styles/js/jquery-3.4.1.min.js', () => {
        $.getScript('//cdn.tms-dist.lan:433/styles/jquery-ui/jquery-ui.min.js', () => {
            console.log('jQuery UI Loaded')
        })
        $('body').children(':last-child').after('<link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/jquery-ui/jquery-ui.min.css">')
    })
</script>
</body>