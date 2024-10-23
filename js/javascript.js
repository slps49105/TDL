$(document).ready(function () {
    $('.hidden').hide();
    $('.day').show();
    $(".content-main").addClass("dy");
    $('.daily').click(function () {
        $(".content-main").addClass("dy");
        $(".content-main").removeClass("wy my iy");
        $(".day").show();
        $('.D').hide();
    });
    $('.weekly').click(function () {
        $(".content-main").addClass("wy");
        $(".content-main").removeClass("dy my iy");
        $(".week").show();
        $('.W').hide();
    });
    $('.monthly').click(function () {
        $(".content-main").addClass("my");
        $(".content-main").removeClass("dy wy iy");
        $(".month").show();
        $('.M').hide();
    });
    $('.irregularly').click(function () {
        $(".content-main").addClass("iy");
        $(".content-main").removeClass("dy wy my");
        $(".irregular").show();
        $('.I').hide();
    });

    $(".add").click(function () {
        $(".add").hide();
        $(".content-main-checkboxs").append
            (
                `   
                <div class="todos">
                    <input type="text" class="todoss" name="todoss">
                    <input type="submit" class="sure" name="sure" value="確定">
                    <input type="submit" class="cancel2" name="cancel" value="取消">
                </div>
                `
            );
    });

    $(".labels").on('click', ".cancel", function () {
        $(".tem").remove();
        $("#dateup").remove();
        $(".update").show();
        $(".delete").show();
    });

    $(window).scroll(function () {
        var scrollPosition = $(window).scrollTop();
        if (scrollPosition > 200) {
            $('.header').addClass('white');
            $('.header').removeClass('vh3');
        } else {
            $('.header').addClass('vh3');
            $('.header').removeClass('white');
        }
    });

    setInterval(() => {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString();
    }, 1000);
})
