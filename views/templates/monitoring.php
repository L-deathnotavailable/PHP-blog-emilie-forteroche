<h2>Monitoring des Articles</h2>

<div class="adminMonitoring">
    <div class="headerRow" style="background-color: #3f56a4; color: white;">
        <div class="headerCell">
            Titre 
            <a href="?action=adminMonitoring&sort=title&dir=asc" class="arrow up" id="title-asc">
                <i class="fa-solid fa-arrow-up"></i>
            </a>
            <a href="?action=adminMonitoring&sort=title&dir=desc" class="arrow down" id="title-desc">
                <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>
        <div class="headerCell">
            Vues
            <a href="?action=adminMonitoring&sort=count_views&dir=asc" class="arrow up" id="views-asc">
                <i class="fa-solid fa-arrow-up"></i>
            </a>
            <a href="?action=adminMonitoring&sort=count_views&dir=desc" class="arrow down" id="views-desc">
                <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>
        <div class="headerCell">
            Commentaires
            <a href="?action=adminMonitoring&sort=comments_count&dir=asc" class="arrow up" id="comments-asc">
                <i class="fa-solid fa-arrow-up"></i>
            </a>
            <a href="?action=adminMonitoring&sort=comments_count&dir=desc" class="arrow down" id="comments-desc">
                <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>
        <div class="headerCell">
            Date de Publication
            <a href="?action=adminMonitoring&sort=date_creation&dir=asc" class="arrow up" id="date-asc">
                <i class="fa-solid fa-arrow-up"></i>
            </a>
            <a href="?action=adminMonitoring&sort=date_creation&dir=desc" class="arrow down" id="date-desc">
                <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>
    </div>

    <?php foreach ($articles as $index => $article) : ?>
        <div class="articleRow" style="color: white; background-color: <?= $index % 2 == 0 ? '#99a140' : '#d79922'; ?>">
            <div class="articleCell"><?= htmlspecialchars($article->getTitle()) ?></div>
            <div class="articleCell"><?= htmlspecialchars($article->getCountViews()) ?></div>
            <div class="articleCell"><?= htmlspecialchars($article->getCountComments()) ?></div>
            <div class="articleCell"><?= htmlspecialchars($article->getDateCreation()->format('Y-m-d H:i:s')) ?></div>
        </div>
    <?php endforeach; ?>
</div>
