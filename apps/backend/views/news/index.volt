<h1 class="page-header">News backend</h1>
<div class="page-bar toolbarBox">
    <div class="btn-toolbar">
        <a href="#" class="toolbar_btn dropdown-toolbar navbar-toggle collapsed" data-toggle="collapse" data-target="#toolbar-nav"><i class="process-icon-dropdown"></i><div>Меню</div></a>
        <ul id="toolbar-nav" class="nav nav-pills pull-right navbar-collapse collapse" style="height: 0px;">
            <li>
                <a id="page-header-desc-category-new-url" class="toolbar_btn  pointer" href="/admin/news/addcategory" title="Добавить новую корневую категорию">
                    <i class="process-icon-new-url"></i>
                    <div>Добавить новую категорию</div>
                </a>
            </li>
            <li>
                <a id="page-header-desc-category-new_category" class="toolbar_btn  pointer" href="/admin/news/addnews" title="Добавить категорию">
                    <i class="process-icon-new"></i>
                    <div>Добавить статью</div>
                </a>
            </li>
        </ul>
    </div>
</div>
{% for new in news %}
    News id: {{ new.id|e }} title: {{ new.title|e }} <br />
    {% elsefor %}
    There are no news to show
{% endfor %}