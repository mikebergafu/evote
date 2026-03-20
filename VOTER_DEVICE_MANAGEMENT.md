# Voter Device Management Feature

## Overview
Added a comprehensive voter management feature that allows administrators to view all voters and their device registration status, with the ability to remove device registrations.

## Files Created

### 1. Livewire Component
**File:** `app/Livewire/Election/ManageVoters.php`
- Lists all voters for an election with pagination
- Search functionality (by name, voter ID, or phone)
- Remove device registration functionality
- Displays voter statistics

### 2. Blade View
**File:** `resources/views/livewire/election/manage-voters.blade.php`
- Clean, modern UI matching the existing design
- Displays voter information in a table format:
  - Voter ID
  - Name
  - Phone number
  - Device registration status (with fingerprint preview)
  - Voting status
  - Actions (remove device registration)
- Statistics cards showing:
  - Total voters
  - Registered devices count
- Search bar for filtering voters
- Pagination support

## Files Modified

### 1. Routes
**File:** `routes/web.php`
- Added route: `/election/{election:uuid}/voters` → `ManageVoters` component

### 2. Manage Election View
**File:** `resources/views/livewire/election/manage.blade.php`
- Added "Manage All" button in the Voters section header
- Links to the detailed voter management page

## Features

### Voter List Display
- Shows all voters with their registration details
- Color-coded status badges:
  - Green: Device registered
  - Gray: Not registered
  - Blue: Has voted
  - Yellow: Pending vote

### Device Registration Management
- View device fingerprint (first 8 characters)
- Remove device registration with confirmation
- Forces voter to re-register their device

### Search & Filter
- Real-time search across:
  - Voter name
  - Voter ID
  - Phone number

### Statistics
- Total voters count
- Registered devices count
- Quick overview of election participation

## Usage

1. Navigate to an election's management page
2. Click "Manage All" button in the Voters section
3. View all voters and their device registration status
4. Use search to find specific voters
5. Click "Remove Device" to clear a voter's device registration
6. Voter will need to register their device again before voting

## Security
- Requires authentication and verification
- Confirmation dialog before removing device registration
- Only election managers can access this feature

## UI/UX
- Responsive design
- Dark mode support
- Smooth transitions and hover effects
- Clear visual indicators for different states
- Pagination for large voter lists
