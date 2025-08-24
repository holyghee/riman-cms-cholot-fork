<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $context, $state, Set $set) {
                                if ($context === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(Page::class, 'slug', ignoreRecord: true)
                            ->helperText('SEO-friendly URL slug. Will be auto-generated from title if left empty.'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->default('draft')
                            ->required(),
                        Forms\Components\Select::make('template')
                            ->options([
                                'default' => 'Default',
                                'cholot-home' => 'Cholot Homepage',
                                'cholot-services' => 'Cholot Services',
                                'cholot-about' => 'Cholot About',
                                'cholot-contact' => 'Cholot Contact',
                                'home' => 'Simple Homepage',
                                'service' => 'Service Page',
                                'contact' => 'Contact Page',
                            ])
                            ->default('cholot-home')
                            ->required()
                            ->reactive(),
                        Forms\Components\Select::make('layout')
                            ->options([
                                'default' => 'Standard',
                                'full-width' => 'Full Width',
                                'sidebar-left' => 'Sidebar Left',
                                'sidebar-right' => 'Sidebar Right',
                            ])
                            ->default('default'),
                        Forms\Components\Textarea::make('excerpt')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->image()
                            ->directory('pages/featured')
                            ->visibility('public')
                            ->disk('public')
                            ->getUploadedFileNameForStorageUsing(
                                fn ($file) => (string) str()->random(40) . '.' . $file->getClientOriginalExtension()
                            )
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                            ->maxSize(10240)
                            ->imagePreviewHeight('250')
                            ->loadingIndicatorPosition('left')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('featured_image_alt')
                            ->label('Featured Image Alt Text')
                            ->columnSpan(1),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Hero Section')
                    ->schema([
                        Forms\Components\Toggle::make('show_hero')
                            ->label('Show Hero Section')
                            ->default(true)
                            ->reactive(),
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Hero Title')
                            ->visible(fn (Get $get) => $get('show_hero')),
                        Forms\Components\Textarea::make('hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(2)
                            ->visible(fn (Get $get) => $get('show_hero')),
                        Forms\Components\FileUpload::make('hero_image')
                            ->label('Hero Background Image/Video')
                            ->directory('pages/hero')
                            ->visibility('public')
                            ->disk('public')
                            ->getUploadedFileNameForStorageUsing(
                                fn ($file) => \Illuminate\Support\Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension()
                            )
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'video/mp4', 'video/webm', 'video/ogg'])
                            ->maxSize(65536)
                            ->imagePreviewHeight('200')
                            ->loadingIndicatorPosition('left')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left')
                            ->openable()
                            ->downloadable()
                            ->helperText('Upload an image, GIF, or video file. Maximum size: 64MB. Filename will be SEO-optimized!')
                            ->visible(fn (Get $get) => $get('show_hero')),
                        Forms\Components\TextInput::make('hero_image_alt')
                            ->label('Hero Image/Video Alt Text')
                            ->placeholder('Describe the hero image/video for SEO and accessibility')
                            ->helperText('Important for SEO and accessibility. Describe what is shown in the media.')
                            ->visible(fn (Get $get) => $get('show_hero') && $get('hero_image')),
                    ])
                    ->columns(2)
                    ->collapsed(),
                    
                Forms\Components\Section::make('Page Builder')
                    ->schema([
                        Forms\Components\Builder::make('blocks')
                            ->label('Content Blocks')
                            ->blocks([
                                // Cholot Services Grid
                                Forms\Components\Builder\Block::make('cholot_services')
                                    ->label('Cholot Services Grid')
                                    ->icon('heroicon-o-squares-2x2')
                                    ->schema([
                                        Forms\Components\TextInput::make('section_title')
                                            ->label('Section Title')
                                            ->default('Our Services'),
                                        Forms\Components\Repeater::make('services')
                                            ->schema([
                                                Forms\Components\FileUpload::make('image')
                                                    ->label('Service Image/Video')
                                                    ->directory('services')
                                                    ->visibility('public')
                                                    ->disk('public')
                                                    ->storeFileNamesIn('image_file_names')
                                                    ->getUploadedFileNameForStorageUsing(
                                                        fn ($file, $get) => 
                                                            \Illuminate\Support\Str::slug($get('title') ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . 
                                                            '-service-' . time() . '.' . $file->getClientOriginalExtension()
                                                    )
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'video/mp4', 'video/webm', 'video/ogg'])
                                                    ->maxSize(65536)
                                                    ->imagePreviewHeight('150')
                                                    ->panelLayout('integrated')
                                                    ->removeUploadedFileButtonPosition('right')
                                                    ->uploadButtonPosition('left')
                                                    ->uploadProgressIndicatorPosition('left')
                                                    ->helperText('SEO-friendly filename based on service title. 64MB max.')
                                                    ->deletable(true)
                                                    ->reorderable(false)
                                                    ->openable(true)
                                                    ->downloadable(true)
                                                    ->required(),
                                                Forms\Components\Select::make('icon')
                                                    ->label('Service Icon')
                                                    ->options([
                                                        'shield' => '🛡️ Shield (Protection)',
                                                        'building' => '🏢 Building (Facilities)',
                                                        'home' => '🏠 Home (Residence)',
                                                        'check' => '✓ Check (Quality)',
                                                        'tools' => '🔧 Tools (Maintenance)',
                                                        'person' => '👤 Person (Staff)',
                                                        'heart' => '❤️ Heart (Care)',
                                                        'medical' => '⚕️ Medical (Health)',
                                                        'dining' => '🍽️ Dining (Food)',
                                                        'wellness' => '💪 Wellness (Fitness)',
                                                        'activities' => '🎨 Activities (Recreation)',
                                                        'community' => '👥 Community (Social)',
                                                    ])
                                                    ->default('home')
                                                    ->required(),
                                                Forms\Components\TextInput::make('category')
                                                    ->label('Category Badge Text')
                                                    ->placeholder('z.B. EXCITING, PREMIUM, WELLNESS...')
                                                    ->maxLength(20)
                                                    ->helperText('Freier Text für das Badge unter dem Icon (max. 20 Zeichen)')
                                                    ->required(),
                                                Forms\Components\TextInput::make('title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2),
                                                Forms\Components\TextInput::make('image_alt')
                                                    ->label('Image/Video Alt Text')
                                                    ->placeholder('Describe the image/video for SEO')
                                                    ->helperText('SEO & Accessibility: Describe the media content.')
                                                    ->columnSpanFull(),
                                                Forms\Components\TextInput::make('link'),
                                            ])
                                            ->columns(2)
                                            ->collapsible()
                                            ->maxItems(6),
                                    ])
                                    ->visible(fn (Get $get) => str_starts_with($get('../template') ?? '', 'cholot')),
                                
                                // Cholot Testimonials
                                Forms\Components\Builder\Block::make('cholot_testimonials')
                                    ->label('Cholot Testimonials')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->schema([
                                        Forms\Components\TextInput::make('section_title')
                                            ->default('What Our Residents Say'),
                                        Forms\Components\Repeater::make('testimonials')
                                            ->schema([
                                                Forms\Components\Textarea::make('quote')
                                                    ->required()
                                                    ->rows(3),
                                                Forms\Components\TextInput::make('author')
                                                    ->required(),
                                                Forms\Components\TextInput::make('role')
                                                    ->placeholder('Resident since 2020'),
                                            ])
                                            ->columns(1)
                                            ->collapsible()
                                            ->maxItems(4),
                                    ])
                                    ->visible(fn (Get $get) => str_starts_with($get('../template') ?? '', 'cholot')),
                                
                                // Cholot CTA
                                Forms\Components\Builder\Block::make('cholot_cta')
                                    ->label('Cholot Call to Action')
                                    ->icon('heroicon-o-megaphone')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required(),
                                        Forms\Components\TextInput::make('subtitle'),
                                        Forms\Components\TextInput::make('button_text')
                                            ->required(),
                                        Forms\Components\TextInput::make('button_link')
                                            ->required(),
                                        Forms\Components\TextInput::make('secondary_button_text'),
                                        Forms\Components\TextInput::make('secondary_button_link'),
                                    ])
                                    ->visible(fn (Get $get) => str_starts_with($get('../template') ?? '', 'cholot')),
                                
                                Forms\Components\Builder\Block::make('text')
                                    ->label('Text Block')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        Forms\Components\TextInput::make('heading')
                                            ->label('Heading'),
                                        Forms\Components\RichEditor::make('content')
                                            ->label('Content')
                                            ->required(),
                                    ]),
                                Forms\Components\Builder\Block::make('image')
                                    ->label('Image Block')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Image')
                                            ->image()
                                            ->directory('pages/blocks')
                                            ->visibility('public')
                                            ->disk('public')
                                            ->storeFileNamesIn('image_file_names')
                                            ->getUploadedFileNameForStorageUsing(
                                                fn ($file) => (string) str()->random(40) . '.' . $file->getClientOriginalExtension()
                                            )
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                                            ->maxSize(10240)
                                            ->imagePreviewHeight('200')
                                            ->panelLayout('integrated')
                                            ->deletable(true)
                                            ->reorderable(false)
                                            ->openable(true)
                                            ->downloadable(false)
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->required(),
                                        Forms\Components\TextInput::make('alt_text')
                                            ->label('Alt Text'),
                                        Forms\Components\TextInput::make('caption')
                                            ->label('Caption'),
                                        Forms\Components\Select::make('alignment')
                                            ->options([
                                                'left' => 'Left',
                                                'center' => 'Center',
                                                'right' => 'Right',
                                                'full' => 'Full Width',
                                            ])
                                            ->default('center'),
                                    ]),
                                Forms\Components\Builder\Block::make('gallery')
                                    ->label('Image Gallery')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Gallery Title'),
                                        Forms\Components\FileUpload::make('images')
                                            ->label('Images')
                                            ->multiple()
                                            ->image()
                                            ->directory('pages/gallery')
                                            ->visibility('public')
                                            ->disk('public')
                                            ->storeFileNamesIn('images_file_names')
                                            ->getUploadedFileNameForStorageUsing(
                                                fn ($file) => (string) str()->random(40) . '.' . $file->getClientOriginalExtension()
                                            )
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                                            ->maxSize(10240)
                                            ->imagePreviewHeight('150')
                                            ->panelLayout('integrated')
                                            ->deletable(true)
                                            ->reorderable(true)
                                            ->openable(true)
                                            ->downloadable(false)
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->required(),
                                        Forms\Components\Select::make('columns')
                                            ->options([
                                                2 => '2 Columns',
                                                3 => '3 Columns',
                                                4 => '4 Columns',
                                            ])
                                            ->default(3),
                                    ]),
                                Forms\Components\Builder\Block::make('cta')
                                    ->label('Call to Action')
                                    ->icon('heroicon-o-cursor-arrow-rays')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Title')
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Description')
                                            ->rows(2),
                                        Forms\Components\TextInput::make('button_text')
                                            ->label('Button Text')
                                            ->required(),
                                        Forms\Components\TextInput::make('button_url')
                                            ->label('Button URL')
                                            ->required(),
                                        Forms\Components\Select::make('style')
                                            ->options([
                                                'primary' => 'Primary',
                                                'secondary' => 'Secondary',
                                                'outline' => 'Outline',
                                            ])
                                            ->default('primary'),
                                    ]),
                                Forms\Components\Builder\Block::make('quote')
                                    ->label('Quote')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->schema([
                                        Forms\Components\Textarea::make('quote')
                                            ->label('Quote Text')
                                            ->required()
                                            ->rows(3),
                                        Forms\Components\TextInput::make('author')
                                            ->label('Author'),
                                        Forms\Components\TextInput::make('position')
                                            ->label('Position/Title'),
                                    ]),
                                Forms\Components\Builder\Block::make('video')
                                    ->label('Video')
                                    ->icon('heroicon-o-film')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Title'),
                                        Forms\Components\TextInput::make('url')
                                            ->label('Video URL (YouTube/Vimeo)')
                                            ->required()
                                            ->url(),
                                        Forms\Components\Select::make('aspect_ratio')
                                            ->options([
                                                '16:9' => '16:9',
                                                '4:3' => '4:3',
                                                '21:9' => '21:9',
                                            ])
                                            ->default('16:9'),
                                    ]),
                            ])
                            ->collapsible()
                            ->collapsed()
                            ->reorderable()
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),
                    
                    
                Forms\Components\Section::make('SEO & Settings')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(60),
                        Forms\Components\Textarea::make('meta_description')
                            ->maxLength(160)
                            ->rows(3),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Keywords (comma separated)'),
                        Forms\Components\FileUpload::make('og_image')
                            ->label('Open Graph Image')
                            ->image()
                            ->directory('pages/og')
                            ->visibility('public')
                            ->disk('public')
                            ->getUploadedFileNameForStorageUsing(
                                fn ($file) => (string) str()->random(40) . '.' . $file->getClientOriginalExtension()
                            )
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                            ->maxSize(10240)
                            ->imagePreviewHeight('250')
                            ->loadingIndicatorPosition('left')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '1:1',
                            ]),
                        Forms\Components\Toggle::make('featured')
                            ->default(false),
                        Forms\Components\Toggle::make('show_sidebar')
                            ->label('Show Sidebar')
                            ->default(false)
                            ->reactive(),
                        Forms\Components\Select::make('sidebar_position')
                            ->options([
                                'left' => 'Left',
                                'right' => 'Right',
                            ])
                            ->default('right')
                            ->visible(fn (Get $get) => $get('show_sidebar')),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->default(now()),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('template')
                    ->badge()
                    ->searchable(),
                Tables\Columns\IconColumn::make('featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
                Tables\Filters\TernaryFilter::make('featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
