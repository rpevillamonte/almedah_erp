//--> start of Dashboard js <--//
if ($("#divMain").children().length == 0) {
    $(document).ready(function () {
        $("#divMain").load("/dashboard");
    });
}
//--> End of Dashboard js <--//

$(document).ready(function () {
    $("body").on("click", ".menu", function () {
        if (!$("#tabs").length) {
            $("#divMain").html(
                `<ul class="nav nav-tabs" id="tabs"></ul>
        <div class="tab-content border-secondary" id="contents"></div>`
            );
        }
        var name = $(this).attr("data-name");
        var moduleWithSpace;
        if (name == undefined) {
            moduleWithSpace = $(this).text().trim();
        } else {
            moduleWithSpace = name;
        }
        var moduleWOSpace = moduleWithSpace.replace(/\s+/g, "");
        var menu = moduleWOSpace;
        console.log(menu);
        //checks if the clicked item has its tab is shown
        if (!$(`#tab${menu}`).length) {
            $("#tabs").append(
                `<li class="nav-item menu-item">
            <a class="nav-link" data-toggle="tab" href="#content${menu}" id="tab${menu}">
                  ${moduleWithSpace} <b class="closeTab text close ml-4">x</b>
            </a>
        </li>`
            );
            // append the content of the tab
            $("#contents").append(
                `<div class="tab-pane active p-0" id="content${menu}">
        </div>`
            );
            //goes to a specific module
            var $link = `${menu}`;
            $(`#content${menu}`).load(
                "/" + $link.toLowerCase(),
                function (responseTxt, statusTxt, xhr) {
                    if (statusTxt == "error")
                        console.log(
                            "Error: " + xhr.status + ": " + xhr.statusText
                        );
                }
            );
            $(`#tab${menu}`).tab("show");
        }
        // if it's active, show it
        else {
            $(`#tab${menu}`).tab("show");
        }
    });
    // function for the close button of the tabs
    $("body").on("click", ".closeTab", function () {
        var $item = $(this).parent().text().trim();
        // if there are no shown tabs, remove all elements
        if (!$("#tabs li").length) {
            $("#divMain").html("");
        } else {
            $(".menu-item").each(function (index) {
                if ($(this).text().trim() == $item) {
                    // checks for the previous sibling if it has one
                    var goTo = $(this).prev().text().trim().length
                        ? $(this).prev().children().attr("id")
                        : $(this).next().children().attr("id");
                    $(`#${goTo}`).tab("show");
                }
            });
        }
        $(this).parent().parent().remove();
        $($(this).parent().attr("href")).remove();

        //--> Additional Dashboard js (close tabs) <--//
        if ($("#tabs").children().length == 0) {
            $(document).ready(function () {
                $("#divMain").load("/dashboard");
            });
        }
        //--> End of Dashboard js (close tabs) <--//
    });
});

function loadNewBOM() {
    $(document).ready(function () {
        $("#contentBOM").load("modules/bomsubModules/newbom.php");
    });
}

function subloadNewBOM() {
    $(document).ready(function () {
        $("#contentBOM").load("modules/newbom.php");
    });
}

/*function loadBOM() {
  $(document).ready(function () {
    $('#contentBOM').load('modules/bom.php');
  });
}*/

function openBlueprint() {
    $(document).ready(function () {
        $("#contentBOM").load("modules/bomsubModules/bomblueprint.php");
    });
}
function openItemInfo() {
    $(document).ready(function () {
        $("#contentInventory").load("modules/itemInfo.php");
    });
}
