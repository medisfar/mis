<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree View Examples with Sample Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .indent-1 { margin-left: 25px; }
        .indent-2 { margin-left: 50px; }
        .indent-3 { margin-left: 75px; }
        .indent-4 { margin-left: 100px; }
        .tree-line { border-left: 1px dashed #d1d5db; margin-left: 12px; }
        .status-active { background-color: #d1fae5; color: #065f46; }
        .status-inactive { background-color: #fee2e2; color: #991b1b; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .type-product { background-color: #dbeafe; color: #1e40af; }
        .type-service { background-color: #f3e8ff; color: #6b21a8; }
        .type-category { background-color: #f0f9ff; color: #0c4a6e; }
        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Tree View Examples with Sample Hierarchical Data</h1>
        
        <!-- Sample Data Structure Display -->
        <div class="mb-10 p-4 bg-blue-50 rounded-lg border border-blue-200">
            <h2 class="text-lg font-semibold text-blue-800 mb-2">Sample Hierarchical Data Structure</h2>
            <pre class="text-sm bg-white p-4 rounded overflow-auto max-h-60">
// JSON representation of sample data
[
  {
    "id": 1,
    "name": "Electronics",
    "type": "category",
    "code": "ELEC",
    "status": "active",
    "description": "Electronic devices category",
    "quantity": 0,
    "price": 0,
    "total_value": 0,
    "parent_id": null,
    "children": [
      {
        "id": 2,
        "name": "Laptops",
        "type": "category",
        "code": "LAP",
        "status": "active",
        "description": "Laptop computers",
        "quantity": 150,
        "price": 0,
        "total_value": 0,
        "parent_id": 1,
        "children": [
          {
            "id": 3,
            "name": "MacBook Pro 16\"",
            "type": "product",
            "code": "MBP16",
            "status": "active",
            "description": "Apple MacBook Pro 16-inch",
            "quantity": 50,
            "price": 2499.99,
            "total_value": 124999.50,
            "parent_id": 2,
            "children": []
          },
          {
            "id": 4,
            "name": "Dell XPS 15",
            "type": "product",
            "code": "DXPS15",
            "status": "active",
            "description": "Dell XPS 15 Laptop",
            "quantity": 75,
            "price": 1799.99,
            "total_value": 134999.25,
            "parent_id": 2,
            "children": []
          }
        ]
      },
      {
        "id": 5,
        "name": "Smartphones",
        "type": "category",
        "code": "PHONE",
        "status": "active",
        "description": "Mobile phones",
        "quantity": 300,
        "price": 0,
        "total_value": 0,
        "parent_id": 1,
        "children": [
          {
            "id": 6,
            "name": "iPhone 15 Pro",
            "type": "product",
            "code": "IP15P",
            "status": "active",
            "description": "Apple iPhone 15 Pro",
            "quantity": 120,
            "price": 999.99,
            "total_value": 119998.80,
            "parent_id": 5,
            "children": []
          }
        ]
      }
    ]
  },
  {
    "id": 7,
    "name": "Furniture",
    "type": "category",
    "code": "FURN",
    "status": "active",
    "description": "Office and home furniture",
    "quantity": 0,
    "price": 0,
    "total_value": 0,
    "parent_id": null,
    "children": [
      {
        "id": 8,
        "name": "Office Chairs",
        "type": "product",
        "code": "OFCHAIR",
        "status": "pending",
        "description": "Ergonomic office chairs",
        "quantity": 25,
        "price": 299.99,
        "total_value": 7499.75,
        "parent_id": 7,
        "children": []
      }
    ]
  }
]
            </pre>
        </div>

        <!-- Example 1: Simple Tree View -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">1. Simple Tree View (Basic Hierarchy)</h2>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="tree-view space-y-1">
                    <!-- Electronics -->
                    <div class="tree-node flex items-center py-1">
                        <button class="text-gray-500 w-6 text-left">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <i class="fas fa-folder text-blue-500 ml-2 mr-3"></i>
                        <span class="font-medium">Electronics</span>
                        <span class="ml-2 text-xs px-2 py-0.5 rounded-full bg-blue-100 text-blue-800">Category</span>
                    </div>
                    
                    <!-- Laptops (indented) -->
                    <div class="tree-node flex items-center py-1 indent-1">
                        <button class="text-gray-500 w-6 text-left">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <i class="fas fa-folder text-blue-400 ml-2 mr-3"></i>
                        <span>Laptops</span>
                        <span class="ml-2 text-xs px-2 py-0.5 rounded-full status-active">Active</span>
                    </div>
                    
                    <!-- MacBook Pro (indented more) -->
                    <div class="tree-node flex items-center py-1 indent-2">
                        <div class="w-6"></div>
                        <i class="fas fa-box text-green-500 ml-2 mr-3"></i>
                        <span>MacBook Pro 16"</span>
                        <span class="ml-2 text-xs px-2 py-0.5 rounded-full type-product">Product</span>
                        <span class="ml-2 text-sm text-gray-500">50 units</span>
                        <span class="ml-2 text-sm font-semibold text-green-600">$2499.99</span>
                    </div>
                    
                    <!-- Dell XPS -->
                    <div class="tree-node flex items-center py-1 indent-2">
                        <div class="w-6"></div>
                        <i class="fas fa-box text-green-500 ml-2 mr-3"></i>
                        <span>Dell XPS 15</span>
                        <span class="ml-2 text-xs px-2 py-0.5 rounded-full type-product">Product</span>
                        <span class="ml-2 text-sm text-gray-500">75 units</span>
                        <span class="ml-2 text-sm font-semibold text-green-600">$1799.99</span>
                    </div>
                    
                    <!-- Smartphones -->
                    <div class="tree-node flex items-center py-1 indent-1">
                        <button class="text-gray-500 w-6 text-left">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <i class="fas fa-folder text-blue-400 ml-2 mr-3"></i>
                        <span>Smartphones</span>
                        <span class="ml-2 text-xs px-2 py-0.5 rounded-full status-active">Active</span>
                    </div>
                    
                    <!-- Furniture (collapsed) -->
                    <div class="tree-node flex items-center py-1">
                        <button class="text-gray-500 w-6 text-left">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <i class="fas fa-folder text-orange-500 ml-2 mr-3"></i>
                        <span class="font-medium">Furniture</span>
                        <span class="ml-2 text-xs px-2 py-0.5 rounded-full bg-orange-100 text-orange-800">Category</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Example 2: Table-Based Tree View -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">2. Table-Based Tree View (With All Fields)</h2>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12"></th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name & Description</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Value</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Electronics Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <i class="fas fa-folder text-blue-500 mr-3"></i>
                                    <div>
                                        <div class="font-medium text-gray-900">Electronics</div>
                                        <div class="text-sm text-gray-500">Electronic devices category</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">ELEC</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full type-category">Category</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full status-active">Active</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">0</td>
                            <td class="px-4 py-3 text-sm text-gray-900">$0.00</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">$0.00</td>
                        </tr>
                        
                        <!-- Laptops Row (indented) -->
                        <tr class="hover:bg-gray-50 bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="pl-6">
                                    <button class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center pl-6">
                                    <i class="fas fa-folder text-blue-400 mr-3"></i>
                                    <div>
                                        <div class="font-medium text-gray-900">Laptops</div>
                                        <div class="text-sm text-gray-500">Laptop computers</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">LAP</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full type-category">Category</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full status-active">Active</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">150</td>
                            <td class="px-4 py-3 text-sm text-gray-900">$0.00</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">$0.00</td>
                        </tr>
                        
                        <!-- MacBook Pro Row (more indented) -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="pl-12">
                                    <div class="w-6 text-center">•</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center pl-12">
                                    <i class="fas fa-box text-green-500 mr-3"></i>
                                    <div>
                                        <div class="font-medium text-gray-900">MacBook Pro 16"</div>
                                        <div class="text-sm text-gray-500">Apple MacBook Pro 16-inch</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">MBP16</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full type-product">Product</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full status-active">Active</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">50</td>
                            <td class="px-4 py-3 text-sm text-gray-900">$2,499.99</td>
                            <td class="px-4 py-3 text-sm font-semibold text-green-600">$124,999.50</td>
                        </tr>
                        
                        <!-- Furniture Row (collapsed) -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <i class="fas fa-folder text-orange-500 mr-3"></i>
                                    <div>
                                        <div class="font-medium text-gray-900">Furniture</div>
                                        <div class="text-sm text-gray-500">Office and home furniture</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">FURN</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full type-category">Category</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full status-active">Active</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">0</td>
                            <td class="px-4 py-3 text-sm text-gray-900">$0.00</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">$0.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Example 3: Card-Based Tree View -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">3. Card-Based Tree View (Detailed View)</h2>
            <div class="space-y-4">
                <!-- Electronics Card -->
                <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden fade-in">
                    <div class="px-4 py-3 bg-blue-50 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <i class="fas fa-folder text-blue-500"></i>
                            <h4 class="font-semibold text-gray-800">Electronics</h4>
                            <span class="text-xs px-2 py-1 rounded-full status-active">Active</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">Code: ELEC</span>
                            <button class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-eye"></i> View Details
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-3">
                            <div>
                                <span class="text-gray-500">Type:</span>
                                <span class="ml-2 font-medium">Category</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Children:</span>
                                <span class="ml-2 font-medium">2 subcategories</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Products:</span>
                                <span class="ml-2 font-medium">3 items</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Total Value:</span>
                                <span class="ml-2 font-medium text-green-600">$379,998.55</span>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600">
                            Electronic devices category including laptops, smartphones, and accessories.
                        </div>
                    </div>
                    
                    <!-- Children Cards (indented) -->
                    <div class="border-t border-gray-200 pl-8 pt-4 pb-4 space-y-4 bg-gray-50">
                        <!-- Laptops Child Card -->
                        <div class="bg-white rounded border border-gray-200 overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <button class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <i class="fas fa-folder text-blue-400"></i>
                                    <h5 class="font-medium text-gray-800">Laptops</h5>
                                    <span class="text-xs px-2 py-1 rounded-full status-active">Active</span>
                                </div>
                                <span class="text-sm text-gray-500">125 units</span>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Code:</span>
                                        <span class="ml-2 font-medium">LAP</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Products:</span>
                                        <span class="ml-2 font-medium">2 items</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Value:</span>
                                        <span class="ml-2 font-medium text-green-600">$259,998.75</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Grandchildren (more indented) -->
                            <div class="border-t border-gray-200 pl-8 pt-3 pb-3 space-y-3 bg-gray-50">
                                <!-- MacBook Pro -->
                                <div class="bg-white rounded border border-gray-200 p-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center">
                                                <i class="fas fa-box text-green-500 mr-2"></i>
                                                <h6 class="font-medium text-gray-800">MacBook Pro 16"</h6>
                                                <span class="ml-2 text-xs px-2 py-0.5 rounded-full type-product">Product</span>
                                            </div>
                                            <div class="mt-1 text-sm text-gray-600">Apple MacBook Pro 16-inch, 512GB SSD</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-semibold text-green-600">$2,499.99</div>
                                            <div class="text-sm text-gray-500">50 in stock</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Dell XPS -->
                                <div class="bg-white rounded border border-gray-200 p-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center">
                                                <i class="fas fa-box text-green-500 mr-2"></i>
                                                <h6 class="font-medium text-gray-800">Dell XPS 15</h6>
                                                <span class="ml-2 text-xs px-2 py-0.5 rounded-full type-product">Product</span>
                                            </div>
                                            <div class="mt-1 text-sm text-gray-600">Dell XPS 15 Laptop, 1TB SSD</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-semibold text-green-600">$1,799.99</div>
                                            <div class="text-sm text-gray-500">75 in stock</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Furniture Card (collapsed) -->
                <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden fade-in">
                    <div class="px-4 py-3 bg-orange-50 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <i class="fas fa-folder text-orange-500"></i>
                            <h4 class="font-semibold text-gray-800">Furniture</h4>
                            <span class="text-xs px-2 py-1 rounded-full status-active">Active</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">Code: FURN</span>
                            <button class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-plus"></i> Expand
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Example 4: Master-Detail Tree View -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">4. Master-Detail Layout</h2>
            <div class="flex flex-col md:flex-row bg-white rounded-lg shadow overflow-hidden">
                <!-- Tree Sidebar -->
                <div class="w-full md:w-1/3 border-r border-gray-200 bg-gray-50">
                    <div class="p-4 border-b bg-white">
                        <h3 class="font-medium">Hierarchy Tree</h3>
                        <input type="text" placeholder="Search..." 
                               class="mt-2 w-full px-3 py-2 border rounded-md text-sm">
                    </div>
                    <div class="p-3 space-y-1">
                        <div class="p-2 rounded hover:bg-blue-50 cursor-pointer border-l-4 border-blue-500 bg-blue-50">
                            <div class="flex items-center">
                                <i class="fas fa-folder text-blue-500 mr-2"></i>
                                <span class="font-medium">Electronics</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-6">2 children • $379,998.55</div>
                        </div>
                        <div class="p-2 rounded hover:bg-gray-100 cursor-pointer ml-4">
                            <div class="flex items-center">
                                <i class="fas fa-folder text-blue-400 mr-2"></i>
                                <span>Laptops</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-6">2 products • $259,998.75</div>
                        </div>
                        <div class="p-2 rounded hover:bg-gray-100 cursor-pointer ml-8 bg-gray-100">
                            <div class="flex items-center">
                                <i class="fas fa-box text-green-500 mr-2"></i>
                                <span class="font-medium">MacBook Pro 16"</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-6">50 units • $124,999.50</div>
                        </div>
                        <div class="p-2 rounded hover:bg-gray-100 cursor-pointer ml-8">
                            <div class="flex items-center">
                                <i class="fas fa-box text-green-500 mr-2"></i>
                                <span>Dell XPS 15</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-6">75 units • $134,999.25</div>
                        </div>
                        <div class="p-2 rounded hover:bg-gray-100 cursor-pointer ml-4">
                            <div class="flex items-center">
                                <i class="fas fa-folder text-blue-400 mr-2"></i>
                                <span>Smartphones</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-6">1 product • $119,998.80</div>
                        </div>
                        <div class="p-2 rounded hover:bg-orange-50 cursor-pointer">
                            <div class="flex items-center">
                                <i class="fas fa-folder text-orange-500 mr-2"></i>
                                <span class="font-medium">Furniture</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-6">1 product • $7,499.75</div>
                        </div>
                    </div>
                </div>
                
                <!-- Detail Panel -->
                <div class="w-full md:w-2/3">
                    <div class="p-6">
                        <!-- Selected Node Header -->
                        <div class="mb-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <i class="fas fa-box text-green-500 text-2xl mr-3"></i>
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900">MacBook Pro 16"</h1>
                                            <div class="flex items-center mt-1 space-x-4">
                                                <span class="text-sm text-gray-500">Code: MBP16</span>
                                                <span class="px-2 py-1 text-xs rounded-full type-product">Product</span>
                                                <span class="px-2 py-1 text-xs rounded-full status-active">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-green-600">$2,499.99</div>
                                    <div class="text-sm text-gray-500">per unit</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tabs -->
                        <div class="border-b border-gray-200 mb-6">
                            <nav class="-mb-px flex space-x-8">
                                <a href="#" class="border-blue-500 text-blue-600 border-b-2 py-2 px-1 font-medium text-sm">Overview</a>
                                <a href="#" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 border-transparent border-b-2 py-2 px-1 font-medium text-sm">Financial</a>
                                <a href="#" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 border-transparent border-b-2 py-2 px-1 font-medium text-sm">Inventory</a>
                                <a href="#" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 border-transparent border-b-2 py-2 px-1 font-medium text-sm">Details</a>
                            </nav>
                        </div>
                        
                        <!-- Tab Content -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <div class="p-3 bg-gray-50 rounded text-gray-700">
                                    Apple MacBook Pro 16-inch with M2 Pro chip, 16GB RAM, 512GB SSD, Liquid Retina XDR display.
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category Path</label>
                                <div class="p-3 bg-gray-50 rounded">
                                    <div class="flex items-center text-sm">
                                        <span class="text-blue-600">Electronics</span>
                                        <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                        <span class="text-blue-600">Laptops</span>
                                        <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                                        <span class="font-medium">MacBook Pro 16"</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Inventory Details</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-gray-50 p-3 rounded text-center">
                                        <div class="text-2xl font-bold text-gray-800">50</div>
                                        <div class="text-xs text-gray-500">In Stock</div>
                                    </div>
                                    <div class="bg-green-50 p-3 rounded text-center">
                                        <div class="text-2xl font-bold text-green-700">$124,999.50</div>
                                        <div class="text-xs text-green-600">Total Value</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Additional Info</label>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Created:</span>
                                        <span>2023-10-15</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Last Updated:</span>
                                        <span>2023-11-20</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Reorder Point:</span>
                                        <span class="text-orange-600">10 units</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comparison Table -->
        <div class="mt-12 p-6 bg-white rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Comparison of Different Tree View Approaches</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Approach</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Best For</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Pros</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Cons</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium">Simple Tree</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Basic navigation, limited fields</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Clean, easy to implement, good for deep hierarchies</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Shows limited data, poor for comparisons</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium">Table-Based</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Many fields, data comparison, reporting</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Shows all fields, easy to scan and compare data</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Can be wide, horizontal scrolling needed</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium">Card-Based</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Complex nodes, detailed information</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Rich display, good for complex data, visual hierarchy</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Takes more vertical space, scrolling intensive</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium">Master-Detail</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Data exploration, administration, complex workflows</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Best UX, full detail view, organized data access</td>
                        <td class="px-4 py-3 text-sm text-gray-500">Complex implementation, requires more screen space</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Simple interactivity for demo
        document.querySelectorAll('.tree-node button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const icon = this.querySelector('i');
                if (icon.classList.contains('fa-chevron-right')) {
                    icon.classList.remove('fa-chevron-right');
                    icon.classList.add('fa-chevron-down');
                } else if (icon.classList.contains('fa-chevron-down')) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-right');
                }
            });
        });
    </script>
</body>
</html>