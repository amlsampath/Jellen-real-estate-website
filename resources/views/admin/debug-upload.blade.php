@extends('admin.layout.admin-layout')

@section('title', 'Debug File Upload')
@section('page-title', 'Debug File Upload')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Test File Upload</h3>
        
        <form method="POST" action="{{ route('debug.upload.test') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <div>
                <label for="test_file" class="block text-sm font-medium text-gray-700 mb-1">Test File</label>
                <input type="file" name="test_file" id="test_file" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                <p class="mt-1 text-sm text-gray-500">Select an image file to test upload</p>
            </div>
            
            <button type="submit" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                Test Upload
            </button>
        </form>
        
        <div class="mt-6">
            <h4 class="text-md font-medium text-gray-900 mb-2">Upload Test Results</h4>
            <div id="upload-results" class="bg-gray-100 p-4 rounded-md">
                <p class="text-sm text-gray-600">Upload a file and check the results here.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const resultsDiv = document.getElementById('upload-results');
    
    resultsDiv.innerHTML = '<p class="text-sm text-blue-600">Testing upload...</p>';
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        resultsDiv.innerHTML = '<p class="text-sm text-green-600">Upload test completed! Check the Laravel logs for detailed information.</p>';
    })
    .catch(error => {
        resultsDiv.innerHTML = '<p class="text-sm text-red-600">Upload test failed: ' + error.message + '</p>';
    });
});
</script>
@endsection
