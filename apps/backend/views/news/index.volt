<h1>News backend</h1>

{% for new in news %}
    News id: {{ new.id|e }} title: {{ new.title|e }} <br />
    {% elsefor %}
    There are no news to show
{% endfor %}