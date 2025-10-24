<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyInquiry;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = PropertyInquiry::with('property');
        
        // Search functionality
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by inquiry type
        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', $request->inquiry_type);
        }
        
        $inquiries = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.inquiries.index', compact('inquiries'));
    }
    
    public function show(PropertyInquiry $inquiry)
    {
        $inquiry->load('property');
        return view('admin.inquiries.show', compact('inquiry'));
    }
    
    public function update(Request $request, PropertyInquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,closed',
        ]);
        
        $inquiry->update($request->only('status'));
        
        return redirect()->route('admin.inquiries.index')
                       ->with('success', 'Inquiry status updated successfully.');
    }
    
    public function destroy(PropertyInquiry $inquiry)
    {
        $inquiry->delete();
        
        return redirect()->route('admin.inquiries.index')
                       ->with('success', 'Inquiry deleted successfully.');
    }
    
    public function markAsContacted(PropertyInquiry $inquiry)
    {
        $inquiry->update(['status' => 'contacted']);
        
        return redirect()->back()
                       ->with('success', 'Inquiry marked as contacted.');
    }
    
    public function markAsClosed(PropertyInquiry $inquiry)
    {
        $inquiry->update(['status' => 'closed']);
        
        return redirect()->back()
                       ->with('success', 'Inquiry marked as closed.');
    }
    
    public function view(PropertyInquiry $inquiry)
    {
        $inquiry->load('property');
        
        return response()->json([
            'success' => true,
            'inquiry' => [
                'id' => $inquiry->id,
                'name' => $inquiry->name,
                'email' => $inquiry->email,
                'phone' => $inquiry->phone,
                'message' => $inquiry->message,
                'inquiry_type' => $inquiry->inquiry_type,
                'status' => $inquiry->status,
                'property_title' => $inquiry->property ? $inquiry->property->title : 'Property not found',
                'property_id' => $inquiry->property_id,
                'created_at' => $inquiry->created_at->format('M d, Y H:i'),
                'updated_at' => $inquiry->updated_at->format('M d, Y H:i'),
            ]
        ]);
    }
}
