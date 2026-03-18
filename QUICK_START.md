# Quick Start Guide - Association Election Voting

## Immediate Next Steps

### 1. Start the Application
```bash
php artisan serve
```
Visit: http://localhost:8000

### 2. Create an Account (if not already logged in)
- Register a new account or log in
- This account will be the election administrator

### 3. Create Your First Election

**From Dashboard:**
1. Click "Create New Election"
2. Fill in:
   - Name: "Board of Directors Election 2026"
   - Description: "Annual election for board positions"
   - Start: [Select date/time - must be in future]
   - End: [Select date/time - must be after start]

3. Add Candidates (minimum 2):
   - Candidate 1: "John Smith" - Bio: "Current treasurer with 5 years experience"
   - Candidate 2: "Jane Doe" - Bio: "Marketing professional and active member"
   - Click "Add Candidate" for each
   
4. Click "Create Election"

### 4. Add Voters

**From Election Management Page:**
1. Add voters using the form:
   - Name: "Alice Johnson"
   - Voter ID: "MEMBER001" (or email: alice@example.com)
   - Click "Add Voter"

2. Repeat for all eligible voters

**Example Voters for Testing:**
```
Name: Bob Wilson    | Voter ID: MEMBER002
Name: Carol Brown   | Voter ID: MEMBER003
Name: David Lee     | Voter ID: MEMBER004
```

### 5. Activate Election
1. Click "Activate Election" button
2. Election is now live!

### 6. Share Voting Link
Copy the voting URL and share with voters:
```
http://localhost:8000/election/1/vote
```

### 7. Test Voting
1. Open voting link in browser
2. Enter voter ID: "MEMBER001"
3. Select a candidate
4. Confirm vote
5. Vote is recorded!

### 8. Monitor Results
- Click "View Results" from management page
- See real-time vote counts and percentages
- Monitor voter turnout

### 9. Close Election
- Click "Close Election" when voting period ends
- Or wait for automatic closure at end date/time

## Important Reminders

⚠️ **Device Lock**: This device is now the ONLY device that can:
- Manage this election
- Access the voting booth
- View results

🔒 **Security**: Keep this device secure during the election period

📊 **Anonymous Voting**: Votes are anonymous - you cannot see who voted for whom

✅ **One Vote Only**: Each voter can only vote once

## Testing Workflow

```bash
# 1. Create election (as admin)
Visit: /election/setup

# 2. Add test voters
MEMBER001, MEMBER002, MEMBER003

# 3. Activate election
Click "Activate Election"

# 4. Cast test votes
Visit: /election/1/vote
Enter: MEMBER001 → Vote for Candidate 1
Enter: MEMBER002 → Vote for Candidate 2
Enter: MEMBER003 → Vote for Candidate 1

# 5. View results
Visit: /election/1/results
Should show: Candidate 1 (2 votes), Candidate 2 (1 vote)
```

## Production Deployment

When ready for production:

1. **Update Environment**
```bash
cp .env .env.backup
nano .env
```

Set:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

2. **Optimize**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Set Permissions**
```bash
chmod -R 755 storage bootstrap/cache
```

4. **Enable HTTPS** (required for production)

## Need Help?

Check the full documentation: `VOTING_SYSTEM_README.md`

View logs:
```bash
tail -f storage/logs/laravel.log
```
