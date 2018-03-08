
function displayJsonNews(apiURL) {
    $.getJSON(apiURL, function(data) {
        let articles = data.articles
            $.each(articles, function(index, e) {
                $('#news-items').append('<div class="news-boxes">' + '<h1>' + e.title  + '</h1>' + '<img style="width: 100%" src="' + e.urlToImage  + '" />' + '<p>' + e.description  + '</p>' + '<a href="' + e.url  + '">See more...</a></div>')
        });
    });
    
}