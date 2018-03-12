
let newsId = 0;
function displayJsonNews(apiURL, apiName, api_id) {
    $.getJSON(apiURL, function(data) {
        let articles = data.articles
        console.log(articles)
        $('#news-container').append('<div class="news-items" data-api="' + apiURL  + '">' + '<a class="delete-cross" href="account.php?delete=' + api_id + '"></a>' + '<h2 data-apiID="' + api_id +  '">' + apiName + '</h2></div>')
        $i = 0
        $.each(articles, function(index, e) {
            if($i < 10) {
                $('*[data-api="' + apiURL + '"]').append('<div class="news-boxes" >' + '<h4>' 
                + e.title  + '</h4>' + '<img style="width: 100%" src="' + e.urlToImage  + '" />' 
                + '<p>' + e.description  + '</p>' + '<a href="' + e.url  
                + '" style="text-decoration: none;">See more...</a><a class="newsId" data-new="getNews' 
                + newsId + '" ></a></div>')
                $i++
            }
            newsId++
        });
    });
    
}

document.addEventListener('DOMContentLoaded', selects)
class LinkedSelect {
    constructor ($select) {
        this.$select = $select
        this.onChange = this.onChange.bind(this)
        this.$select.addEventListener('change', this.onChange)
    }

    onChange (e) {
        let request = new XMLHttpRequest()
        request.open('GET', this.$select.dataset.source.replace('$id', e.target.value), true)
        request.onload = () => {
            if(request.status >= 200 && request.status < 400) {
                let data = JSON.parse(request.responseText)
                let options = data.reduce(function(acc, option) {
                    return acc + '<option value="' + option.api_id + '">' + option.api_name + '</option>'
                }, '')
                let target = document.querySelector(this.$select.dataset.target)
                target.innerHTML = options
            }else {
                alert('Access Denied')
            }
        }
        request.onerror = function() {
            alert('VTF')
        }
        request.send()
    }
}
function selects() {
    let $selects = document.querySelectorAll('.linked-select')

    $selects.forEach(function($select) {
        new LinkedSelect($select)
    })
    setTimeout(() => {
        $news = $('.newsId')
        $news.each(function($i) {
            $(this).on("click", function() {
                $tab = $(this).parent()
                $element = {
                    title: $tab[0].childNodes[0].innerText,
                    img: $tab[0].childNodes[1].currentSrc,
                    desc: $tab[0].childNodes[2].innerText,
                    link: $tab[0].childNodes[3].href,
                    api_id: $tab.parent()[0].childNodes[1].dataset.apiid
                }
                
                $.ajax({
                    type: "post",
                    url: "addbookmark.php",
                    data: "title=" + $element.title + "&img=" +  $element.img + "&desc=" +  $element.desc + "&link=" +  $element.link + "&api_id=" +  $element.api_id,
                    dataType: 'html',
                    success: function (code, state) {
                      alert("The article from " + $tab.parent()[0].childNodes[1].innerText + " has been added to your bookmarks")
                    }
                  });
            })
        })
    }, 3000)
}

