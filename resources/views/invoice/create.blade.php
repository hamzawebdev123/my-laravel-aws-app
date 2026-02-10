<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="bg-gradient-to-br from-blue-50 to-gray-200 min-h-screen p-4 md:p-12">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Invoice<span class="text-blue-600">Swift</span></h1>
                <p class="text-gray-500">Professional Billing Made Easy</p>
            </div>
            <i class="fa-solid fa-file-invoice-dollar text-5xl text-blue-600 opacity-20"></i>
        </div>

        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
            <form action="/invoice/download" method="POST" class="p-8">
                @csrf
                
                <div class="mb-10">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-blue-600 mb-4 flex items-center">
                        <i class="fa-solid fa-user-tie mr-2"></i> Client Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <input type="text" name="client_name" class="peer w-full border-b-2 border-gray-300 px-0 py-2 focus:border-blue-600 focus:outline-none placeholder-transparent" placeholder="Name" required>
                            <label class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-blue-600 peer-focus:text-sm">Client Name</label>
                        </div>
                        <div class="relative">
                            <input type="email" name="client_email" class="peer w-full border-b-2 border-gray-300 px-0 py-2 focus:border-blue-600 focus:outline-none placeholder-transparent" placeholder="Email">
                            <label class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-blue-600 peer-focus:text-sm">Client Email</label>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-blue-600 mb-4 flex items-center">
                        <i class="fa-solid fa-list-check mr-2"></i> Service Details
                    </h3>
                    <div class="bg-gray-50 p-6 rounded-xl border border-dashed border-gray-300">
                        <div class="flex flex-wrap gap-4 items-end">
                            <div class="flex-[3] min-w-[200px]">
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">Description</label>
                                <input type="text" name="item" class="w-full rounded-lg border-gray-200 p-3 focus:ring-blue-500 focus:border-blue-500 border" placeholder="description">
                            </div>
                            <div class="flex-1 min-w-[80px]">
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">Qty</label>
                                <input type="number" id="qty" name="qty" value="1" class="w-full rounded-lg border-gray-200 p-3 text-center border">
                            </div>
                            <div class="flex-1 min-w-[120px]">
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">Price ($)</label>
                                <input type="number" id="price" name="price" placeholder="0.00" class="w-full rounded-lg border-gray-200 p-3 border">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-center bg-gray-900 rounded-xl p-8 text-white">
                    <div class="mb-4 md:mb-0">
                        <span class="text-gray-400 block text-sm">Amount Due</span>
                        <span class="text-4xl font-bold">$ <span id="total_display">0.00</span></span>
                        <input type="hidden" name="total" id="total_input">
                    </div>
                    <button type="submit" class="group bg-blue-600 hover:bg-blue-500 px-8 py-4 rounded-lg font-bold flex items-center transition-all shadow-xl active:scale-95">
                        <i class="fa-solid fa-cloud-arrow-down mr-3 animate-bounce"></i> 
                        Generate Invoice
                    </button>
                </div>
            </form>
        </div>
        <p class="text-center mt-6 text-gray-400 text-sm">Built with Laravel & Docker • Powered by YourServer</p>
    </div>
</div>

<script>
    const qtyInput = document.getElementById('qty');
    const priceInput = document.getElementById('price');
    const totalDisplay = document.getElementById('total_display');
    const totalInput = document.getElementById('total_input');

    function calculate() {
        const total = (parseFloat(qtyInput.value) || 0) * (parseFloat(priceInput.value) || 0);
        totalDisplay.innerText = total.toLocaleString(undefined, {minimumFractionDigits: 2});
        totalInput.value = total;
    }

    qtyInput.addEventListener('input', calculate);
    priceInput.addEventListener('input', calculate);
</script>