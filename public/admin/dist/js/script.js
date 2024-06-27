$("#seo_description").keyup(function () {
    saydir("seo_description", "seodes", 1, 120, 157);
});
$("#seo_description").focusout(function () {
    saydir("seo_description", "seodes", 1, 120, 157);
});
$("#seo_title").keyup(function () {
    saydir("seo_title", "seotit", 1, 40, 60);
});
$("#seo_title").focusout(function () {
    saydir("seo_title", "seotit", 1, 40, 60);
});

function saydir(a, b, d1, d2, d3) {
    var x = $("#" + a).val().length;
    $("#" + b).html(x);
    if (x < d1)
        document.getElementById(b).className = "pull-right input-group-text";
    if (x > d1 && x < d2)
        document.getElementById(b).className =
            "pull-right text-warning input-group-text";
    if (x > d2 && x < d3)
        document.getElementById(b).className =
            "pull-right text-success input-group-text";
    if (x > d3)
        document.getElementById(b).className =
            "pull-right text-danger input-group-text";
}

$(document).ready(function () {
    $("#title").keyup(function () {
        if ($("#title").val() == "") {
            $("#title").removeClass("is-valid");
            $("#title").addClass("is-invalid");
        } else {
            $("#title").removeClass("is-invalid");
            $("#title").addClass("is-valid");
        }
        clearInput($(this).attr("id"));
    });
    $("#title").focusout(function () {
        if ($("#title").val() == "") {
            $("#title").removeClass("is-valid");
            $("#title").addClass("is-invalid");
        } else {
            $("#title").removeClass("is-invalid");
            $("#title").addClass("is-valid");
        }
        clearInput($(this).attr("id"));
    });
    $("#file_id").focusout(function () {
        if ($("#file_id").val() == "") {
            $("#file_id").removeClass("is-valid");
            $("#file_id").addClass("is-invalid");
        } else {
            $("#file_id").removeClass("is-invalid");
            $("#file_id").addClass("is-valid");
        }
        clearInput($(this).attr("id"));
    });
    $("#submit").click(function () {
        const fieldIds = ["title", "category", "content", "language"];
        let isEmpty = false;
        fieldIds.forEach(function (fieldId) {
            if ($("#" + fieldId).val() == "") {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else if ($("#" + fieldId).val() == 0) {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else {
                $("#" + fieldId).removeClass("is-invalid");
                $("#" + fieldId).addClass("is-valid");
            }
        });
        if (isEmpty) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return;
        }

        $("#form").submit();
    });

    $("#submitMembers").click(function () {
        const fieldIds = [
            "title",
            "category",
            "content",
            "language",
            "email",
            "phone",
        ];
        let isEmpty = false;
        fieldIds.forEach(function (fieldId) {
            if ($("#" + fieldId).val() == "") {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else if ($("#" + fieldId).val() == 0) {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else {
                $("#" + fieldId).removeClass("is-invalid");
                $("#" + fieldId).addClass("is-valid");
            }
        });
        if (isEmpty) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return;
        }

        $("#form").submit();
    });

    $("#submitparish").click(function () {
        const fieldIds = [
            "category_id",
            "parish_name",
            // "parish_priest",
            // "patron",
            "established_year",
            // "tamil_population",
            // "malayalam_population",
            "vicariate",
            "address",
        ];
        let isEmpty = false;
        fieldIds.forEach(function (fieldId) {
            if ($("#" + fieldId).val() == "") {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else if ($("#" + fieldId).val() == 0) {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else {
                $("#" + fieldId).removeClass("is-invalid");
                $("#" + fieldId).addClass("is-valid");
            }
        });
        if (isEmpty) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return;
        }

        $("#form").submit();
    });

    $("#submitpriest").click(function () {
        const fieldIds = ["category_id", "name"];
        let isEmpty = false;
        fieldIds.forEach(function (fieldId) {
            if ($("#" + fieldId).val() == "") {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else if ($("#" + fieldId).val() == 0) {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else {
                $("#" + fieldId).removeClass("is-invalid");
                $("#" + fieldId).addClass("is-valid");
            }
        });
        if (isEmpty) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return;
        }

        $("#form").submit();
    });

    $("#submitcontact").click(function () {
        const fieldIds = ["phone", "cell", "email", "address", "map"];
        let isEmpty = false;
        fieldIds.forEach(function (fieldId) {
            if ($("#" + fieldId).val() == "") {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else if ($("#" + fieldId).val() == 0) {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else {
                $("#" + fieldId).removeClass("is-invalid");
                $("#" + fieldId).addClass("is-valid");
            }
        });
        if (isEmpty) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return;
        }

        $("#form").submit();
    });

    $("#socialmediasubmit").click(function () {
        const fieldIds = ["title", "channelid", "apikey", "mediaurl", "counts"];
        let isEmpty = false;
        fieldIds.forEach(function (fieldId) {
            if ($("#" + fieldId).val() == "") {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else if ($("#" + fieldId).val() == 0) {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else {
                $("#" + fieldId).removeClass("is-invalid");
                $("#" + fieldId).addClass("is-valid");
            }
        });
        if (isEmpty) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return;
        }

        $("#form").submit();
    });

    $("#submitnewsletter").click(function () {
        const fieldIds = ["title", "category", "eventdate"];
        let isEmpty = false;
        fieldIds.forEach(function (fieldId) {
            if ($("#" + fieldId).val() == "") {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else if ($("#" + fieldId).val() == 0) {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else {
                $("#" + fieldId).removeClass("is-invalid");
                $("#" + fieldId).addClass("is-valid");
            }
        });
        if (isEmpty) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return;
        }

        $("#form").submit();
    });

    $("#submitslide").click(function () {
        const fieldIds = ["title", "image"];
        let isEmpty = false;
        fieldIds.forEach(function (fieldId) {
            if ($("#" + fieldId).val() == "") {
                $("#" + fieldId).removeClass("is-valid");
                $("#" + fieldId).addClass("is-invalid");
                isEmpty = true;
            } else {
                $("#" + fieldId).removeClass("is-invalid");
                $("#" + fieldId).addClass("is-valid");
            }
        });
        if (isEmpty) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return;
        }
        $("#form").submit();
    });
});

function clearInput(id) {
    var charMap = {
        Ç: "c",
        Ö: "o",
        Ş: "s",
        İ: "i",
        I: "i",
        Ü: "u",
        Ğ: "g",
        ç: "c",
        ö: "o",
        ş: "s",
        ı: "i",
        ü: "u",
        ğ: "g",
    };
    var str = $("#" + id).val();
    str_array = str.split("");
    for (var i = 0, len = str_array.length; i < len; i++) {
        str_array[i] = charMap[str_array[i]] || str_array[i];
    }
    str = str_array.join("");
    var clearStr = str
        .replace(/\ /g, "-")
        .replace(/\--/g, "-")
        .replace(/[^a-z0-9-çöşüğı]/gi, "")
        .toLowerCase();
    $("#slug").val(clearStr);
}

function validate(e) {
    if (confirm("Are you sure you want to delete this item?"))
        $("#delete_" + e).submit();
}

$(function () {
    $("#content").summernote();
    $("#history").summernote();
    $("#social_movements").summernote();
    $("#pious_associations").summernote();
    $(".summary").summernote();
});

$("#category").change(function () {
    $("#category_id").val($("select option:selected").val());
});


$("#choose").click(function () {
    $(".overlay-back").css("display", "block");
    $(".choose-panel").css("display", "block");
    $("body").css("overflow", "hidden");
});
$('#add_media').click(function () {
    $(".allmedia").css("display", "none");
    $(".add-medias").css("display", "block");
    $("body").css("overflow", "hidden");
    
});
$('#allmedia').click(function () {
    $(".allmedia").css("display", "block");
    $(".add-medias").css("display", "none");
    $("body").css("overflow", "hidden");
});
$("#close").click(function () {
    $(".overlay-back").css("display", "none");
    $(".choose-panel").css("display", "none");
    $("body").css("overflow", "unset");
});

$("#add").click(function () {
    var media_img = $("#onizleme").attr("src");
    var media_id = $("#media").val();
    $("#media_img").attr("src", media_img);
    $("#media_id").attr("value", media_id);
    $("#urltext").val(media_img);

    $(".overlay-back").css("display", "none");
    $(".choose-panel").css("display", "none");
    $("body").css("overflow", "unset");
    $("#add_image").show();
    $("#close_img").show();
});

$("#chooseimg").click(function () {
    $(".overlay-back").css("display", "block");
    $(".choose-panel").css("display", "block");
    $("body").css("overflow", "hidden");
    $("#add").hide();
    $("#close").hide();
});

$("#add_image").click(function () {
    var media_img = $("#onizleme").attr("src");
    $("#urltext_img").val(media_img);
    $(".overlay-back").css("display", "none");
    $(".choose-panel").css("display", "none");
    $("body").css("overflow", "unset");
    $("#add").show();
    $("#close").show();
});
$("#close_img").click(function () {
    $(".overlay-back").css("display", "none");
    $(".choose-panel").css("display", "none");
    $("body").css("overflow", "unset");
    $("#add").show();
    $("#close").show();
});

$("#remove").click(function () {
    var media_img = "";
    var media_id = 1;
    $("#media_img").attr("src", media_img);
    $("#media_id").attr("value", media_id);
});

$(document).on("click", ".choose-panel .thumbnail img", function () {
    var alt = $(this).attr("alt");
    var id = $(this).attr("id");
    var url = $(this).attr("data-url");
    var title = $(this).attr("data-title");
    $("#onizleme").attr("src", url);
    $("#media").val(id);
    $("#media_url").val(url);
    $("#media_title").val(title);
    $("#media_alt").val(alt);
    $("#form_img").attr("action", id);
});

$("nav.justify-between").hide();

$(function () {
    $("#table1").DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        /*"language": {
                "sDecimal":        ",",
                "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
                "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                "sInfoEmpty":      "Kayıt yok",
                "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ".",
                "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
                "sLoadingRecords": "Yükleniyor...",
                "sProcessing":     "İşleniyor...",
                "sSearch":         "Ara:",
                "sZeroRecords":    "Eşleşen kayıt bulunamadı",
                "oPaginate": {
                    "sFirst":    "İlk",
                    "sLast":     "Son",
                    "sNext":     "Sonraki",
                    "sPrevious": "Önceki"
                },
                "oAria": {
                    "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                    "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
                },
                "select": {
                    "rows": {
                        "_": "%d kayıt seçildi",
                        "0": "",
                        "1": "1 kayıt seçildi"
                    }
                }
            }*/
    });
});

$(function () {
    $(".infinite-scroll").jscroll({
        autoTrigger: true,
        loadingHtml:
            '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
        padding: 0,
        nextSelector: "nav.justify-between a:nth-child(2)",
        contentSelector: "div.scroll-content",
        callback: function () {
            $("nav.justify-between").remove();
        },
    });
});

$("#submit_img").click(function () {
    var form = $("#form_img");
    var id = $("#form_img #media").val();
    var inputs = form.find("input, select, button, textarea");
    $.ajax({
        dataType: "text",
        type: "post",
        url: window.location.origin + "/admin/media/" + id,
        data: form.serialize(),
        beforeSend: function () {
            $("#submit_img").html("Kaydediliyor...");
            inputs.prop("disabled", true);
        },
        success: function (response) {
            response = response.split(",");
            if (response[0] == "success") {
                toastr.success(response[1]);
            } else {
                toastr.error(response[1]);
            }
        },
        error: function (res) {
            //alert(res.responseText);
            toastr.error("Fotoğraf Seçimi Yapmalısınız!");
        },
        complete: function () {
            $("#submit_img").html("Güncelle");
            inputs.prop("disabled", false);
        },
    });
});

$(function () {
    $(".sortable-topic").sortable({
        revert: true,
        handle: ".move-topic",
    });
    $(".move-topic").disableSelection();
    $(".sortable-lesson").sortable({
        revert: true,
        handle: ".move-lesson",
    });
    $(".move-lesson").disableSelection();
});

$("#submitmainmenu").click(function () {
    const fieldIds = ["title", "link"];
    let isEmpty = false;
    fieldIds.forEach(function (fieldId) {
        if ($("#" + fieldId).val() == "") {
            $("#" + fieldId).removeClass("is-valid");
            $("#" + fieldId).addClass("is-invalid");
            isEmpty = true;
        } else if ($("#" + fieldId).val() == 0) {
            $("#" + fieldId).removeClass("is-valid");
            $("#" + fieldId).addClass("is-invalid");
            isEmpty = true;
        } else {
            $("#" + fieldId).removeClass("is-invalid");
            $("#" + fieldId).addClass("is-valid");
        }
    });
    if (isEmpty) {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return;
    }

    $("#form").submit();
});

$("#submitSubmenu").click(function () {
    const fieldIds = ["title", "link", "parent_id"];
    let isEmpty = false;
    fieldIds.forEach(function (fieldId) {
        if ($("#" + fieldId).val() == "") {
            $("#" + fieldId).removeClass("is-valid");
            $("#" + fieldId).addClass("is-invalid");
            isEmpty = true;
        } else if ($("#" + fieldId).val() == 0) {
            $("#" + fieldId).removeClass("is-valid");
            $("#" + fieldId).addClass("is-invalid");
            isEmpty = true;
        } else {
            $("#" + fieldId).removeClass("is-invalid");
            $("#" + fieldId).addClass("is-valid");
        }
    });
    if (isEmpty) {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return;
    }

    $("#form").submit();
});
