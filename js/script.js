document.addEventListener('DOMContentLoaded', function() {
    // Fonction de confirmation pour la suppression de commentaire
    function confirmDeleteComment(event) {
        event.preventDefault(); // Empêche la redirection immédiate
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir supprimer le commentaire ?',
            text: "Cette action est irréversible.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = event.target.href; // Redirection si confirmé
            }
        });
        return false;
    }

    // Ajout de la confirmation sur les liens de suppression
    const deleteLinks = document.querySelectorAll('.btn-delete-comment');
    deleteLinks.forEach(link => {
        link.addEventListener('click', confirmDeleteComment);
    });

    // Sélectionne tous les éléments d'article
    const articles = document.querySelectorAll('.article');

    // Ajoute un événement de clic à chaque article
    articles.forEach(article => {
        article.addEventListener('click', function() {
            // Redirige vers l'URL spécifiée dans data-href
            window.location.href = this.getAttribute('data-href');
        });
    });

});
