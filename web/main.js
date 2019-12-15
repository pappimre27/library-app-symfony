function sortTable() {
    const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
    const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
            v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

    document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
        const table = th.closest('table');
        const tbody = table.querySelector('tbody');
        Array.from(tbody.querySelectorAll('tr'))
            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
            .forEach(tr => tbody.appendChild(tr));
    })));
}

function deleteBook() {
    const books = document.getElementById('books');
    if (books) {
        books.addEventListener('click', e => {
            if (e.target.className === 'btn btn-danger delete-book') {
                if (confirm('Are you sure?')) {
                    const id = e.target.getAttribute('data-id');
                    fetch(`/book/delete/${id}`, {
                        method: 'DELETE'
                    })
                        .then(res => window.location.reload())
                        .catch(err => console.error(err));
                }
            }
        });
    }
}

window.onload = () => {
    sortTable();
    deleteBook();
};