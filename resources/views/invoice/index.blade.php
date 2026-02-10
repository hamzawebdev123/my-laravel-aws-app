<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="bg-gray-50 min-h-screen p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Invoice <span class="text-blue-600">History</span></h2>
            <a href="/" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> New Invoice
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-900 text-white text-sm uppercase">
                    <tr>
                        <th class="p-4">Invoice #</th>
                        <th class="p-4">Client</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Amount</th>
                        <th class="p-4 text-center">Actions</th>
                        <th class="p-4 text-center">Download</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($invoices as $inv)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="p-4 font-mono font-bold text-blue-600">{{ $inv->invoice_number }}</td>
                        <td class="p-4">
                            <div class="font-semibold text-gray-800">{{ $inv->client_name }}</div>
                            <div class="text-xs text-gray-400">{{ $inv->client_email }}</div>
                        </td>
                        <td class="p-4 text-gray-600">{{ $inv->created_at->format('d M, Y') }}</td>
                        <td class="p-4 font-bold text-gray-900">${{ number_format($inv->total_amount, 2) }}</td>
                        <td class="p-4 text-center">
                            <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full text-xs font-bold">Generated</span>
                        </td>
                        <td class="p-4 text-center">
    <a href="{{ route('invoice.redownload', $inv->id) }}" 
       class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg hover:bg-blue-600 hover:text-white transition-all border border-blue-200 shadow-sm">
        <i class="fa-solid fa-download mr-2"></i> Download PDF
    </a>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-20 text-center text-gray-400">
                            <i class="fa-solid fa-folder-open text-5xl mb-4 block opacity-20"></i>
                            No invoices found. Create your first one!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>