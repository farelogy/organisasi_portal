<!-- AJAX Pagination Script (shared by event listing pages) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eventsContainer = document.getElementById('events-container');
        const loadingIndicator = document.getElementById('loading-indicator');
        if (!eventsContainer) return;
        let isLoading = false;

        function handlePaginationClick(e) {
            e.preventDefault();
            if (isLoading) return;
            const link = e.target.closest('a');
            if (!link || !link.href || !link.href.includes('page=')) return;

            isLoading = true;
            if (loadingIndicator) loadingIndicator.classList.remove('hidden');
            eventsContainer.classList.add('opacity-50');

            fetch(link.href, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                eventsContainer.innerHTML = data.html;
                const filterBar = document.querySelector('section.py-16 .flex.flex-wrap');
                if (filterBar) filterBar.scrollIntoView({ behavior: 'smooth', block: 'start' });
                window.history.pushState({}, '', link.href);
                attachPaginationListeners();
                if (typeof AOS !== 'undefined') AOS.refresh();
            })
            .catch(error => {
                console.error('Error loading events:', error);
                window.location.href = link.href;
            })
            .finally(() => {
                isLoading = false;
                if (loadingIndicator) loadingIndicator.classList.add('hidden');
                eventsContainer.classList.remove('opacity-50');
            });
        }

        function attachPaginationListeners() {
            const links = eventsContainer.querySelectorAll('a[href*="page="]');
            links.forEach(link => link.addEventListener('click', handlePaginationClick));
        }

        attachPaginationListeners();
        window.addEventListener('popstate', () => window.location.reload());
    });
</script>
