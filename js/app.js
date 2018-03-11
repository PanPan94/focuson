
function displayJsonNews(apiURL, apiName, api_id) {
    $.getJSON(apiURL, function(data) {
        let articles = data.articles
        console.log(articles)
        $('#news-container').append('<div class="news-items" data-api="' + apiURL  + '">' + '<a class="delete-cross" href="account.php?delete=' + api_id + '"></a>' + '<h2>' + apiName + '<h2></div>')
        $i = 0
        $.each(articles, function(index, e) {
            if($i < 10) {
                $('*[data-api="' + apiURL + '"]').append('<div class="news-boxes" >' + '<h4>' + e.title  + '</h4>' + '<img style="width: 100%" src="' + e.urlToImage  + '" />' + '<p>' + e.description  + '</p>' + '<a href="' + e.url  + '">See more...</a></div>')
                $i++
            }
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
}