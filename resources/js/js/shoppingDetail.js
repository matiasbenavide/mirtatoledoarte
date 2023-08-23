export async function main()
{
    let detailDropdown = $('#detailDropdown');
    let shoppingDetail = $('#shoppingDetail');

    detailDropdown.on('click', function() {
        shoppingDetail.toggle('hidden');
    })
}
