let goButton = document.getElementById("MemberForm");
$(document).ready(function () {
    $(goButton).submit(function (e) {
        e.preventDefault();
        let MemberIdValue = document.getElementById("MemId").value;
        $.ajax({url: `MemberHistory.php?MemId=${MemberIdValue}`,
            method: "GET",

            success: function (result) {

                $("#MemberHTML").html(result);
            },
            
            error: function (xhr, status, error){
                let errorMessage = `${xhr.status} - ${xhr.statusText}`;
                alert(`Error - ${errorMessage}`);
            }
        });
    });
});



