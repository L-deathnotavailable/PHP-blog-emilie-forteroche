<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles() : array
    {
        $sql = "SELECT * FROM article";
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }
    
    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id) : ?Article
    {
        $sql = "SELECT * FROM article WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Incrémente le compteur de vues pour un article donné.
     * @param int $id : l'id de l'article.
     * @return void
     */
    public function incrementArticleViews(int $id) : void
    {
        $sql = "UPDATE article SET count_views = count_views + 1 WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article) : void 
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article) : void
    {
        $sql = "INSERT INTO article (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article) : void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId()
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id) : void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Récupère tous les articles avec leur nombre de vues, de commentaires et la date de publication.
     * @return array : un tableau d'objets Article avec stats.
     */
    public function getAllArticlesWithStats(string $sort = 'date_creation', string $dir = 'desc') : array 
    {
        // On vérifie que les paramètres sont valides pour éviter les injections SQL
        $allowedSorts = ['title', 'count_views', 'comments_count', 'date_creation'];
        $allowedDirs = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'date_creation';
        }
        if (!in_array($dir, $allowedDirs)) {
            $dir = 'desc';
        }

        $sql = "SELECT a.id, a.title, a.count_views, a.date_creation, COUNT(c.id) as comments_count
                FROM article as a
                LEFT JOIN comment c ON a.id = c.id_article
                GROUP BY a.id
                ORDER BY $sort $dir"; // On utilise ici les paramètres de tri validés

        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }
    public function getCountCommentsByArticleId(int $articleId) : int{
        $sql = "SELECT COUNT(*) as count FROM comment WHERE id_article= :articleId;";
        $result= $this->db->query($sql, ['articleId' => $articleId]);
        $count= $result -> fetch ()['count'];
        return $count;
    }

}