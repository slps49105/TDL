$(document).ready(function () {
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
