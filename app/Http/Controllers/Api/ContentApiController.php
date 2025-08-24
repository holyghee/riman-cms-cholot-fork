<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentApiController extends Controller
{
    /**
     * List all pages
     */
    public function index()
    {
        $pages = Page::select('id', 'title', 'slug', 'status', 'created_at', 'updated_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pages
        ]);
    }

    /**
     * Get a specific page with all blocks
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $page
        ]);
    }

    /**
     * Create a new page
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:pages',
            'blocks' => 'nullable|array',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'nullable|in:draft,published'
        ]);

        if (!isset($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $page = Page::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Page created successfully',
            'data' => $page
        ], 201);
    }

    /**
     * Update a page
     */
    public function update(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|unique:pages,slug,' . $page->id,
            'blocks' => 'nullable|array',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'nullable|in:draft,published'
        ]);

        $page->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Page updated successfully',
            'data' => $page
        ]);
    }

    /**
     * Update specific blocks on a page
     */
    public function updateBlocks(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }

        $validated = $request->validate([
            'blocks' => 'required|array'
        ]);

        $page->blocks = $validated['blocks'];
        $page->save();

        return response()->json([
            'success' => true,
            'message' => 'Blocks updated successfully',
            'data' => $page->blocks
        ]);
    }

    /**
     * Add a single block to a page
     */
    public function addBlock(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }

        $validated = $request->validate([
            'type' => 'required|string',
            'data' => 'required|array',
            'position' => 'nullable|integer'
        ]);

        $blocks = $page->blocks ?? [];
        $newBlock = [
            'type' => $validated['type'],
            'data' => $validated['data']
        ];

        if (isset($validated['position'])) {
            array_splice($blocks, $validated['position'], 0, [$newBlock]);
        } else {
            $blocks[] = $newBlock;
        }

        $page->blocks = $blocks;
        $page->save();

        return response()->json([
            'success' => true,
            'message' => 'Block added successfully',
            'data' => $page->blocks
        ]);
    }

    /**
     * Delete a page
     */
    public function destroy($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }

        $page->delete();

        return response()->json([
            'success' => true,
            'message' => 'Page deleted successfully'
        ]);
    }

    /**
     * Get available block types
     */
    public function blockTypes()
    {
        $blockTypes = [
            'cholot_hero' => [
                'name' => 'Hero Section',
                'fields' => ['title', 'subtitle', 'description', 'cta_text', 'cta_link']
            ],
            'cholot_services' => [
                'name' => 'Services Grid',
                'fields' => ['section_title', 'services' => ['title', 'description', 'image', 'link']]
            ],
            'cholot_testimonials' => [
                'name' => 'Testimonials',
                'fields' => ['section_title', 'testimonials' => ['quote', 'author', 'role']]
            ],
            'cholot_cta' => [
                'name' => 'Call to Action',
                'fields' => ['title', 'subtitle', 'button_text', 'button_link']
            ],
            'text' => [
                'name' => 'Text Content',
                'fields' => ['heading', 'content']
            ],
            'image' => [
                'name' => 'Image',
                'fields' => ['image', 'alt_text', 'caption', 'alignment']
            ],
            'gallery' => [
                'name' => 'Image Gallery',
                'fields' => ['title', 'images', 'columns']
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $blockTypes
        ]);
    }
}