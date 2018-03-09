
function displayJsonNews(apiURL) {
    // apiURL = apiURL + '&callback=?' 
    $.getJSON(apiURL, function(data) {
        let articles = data.articles
        console.log(articles)
        $('#news-container').append('<div class="news-items" data-api="' + apiURL  + '"></div>')
        $i = 0
        $.each(articles, function(index, e) {
            if($i < 10) {
                $('*[data-api="' + apiURL + '"]').append('<div class="news-boxes" >' + '<h1>' + e.title  + '</h1>' + '<img style="width: 100%" src="' + e.urlToImage  + '" />' + '<p>' + e.description  + '</p>' + '<a href="' + e.url  + '">See more...</a></div>')
                $i++
            }
        });
    });
    
}