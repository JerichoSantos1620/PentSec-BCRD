<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Personal Data Sheet - {{ $form->full_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            color: #1a1a1a;
            font-size: 11pt;
            line-height: 1.5;
        }
        .page {
            padding: 40px 50px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e5e7eb;
        }
        .header-subtitle {
            font-size: 9pt;
            color: #6b7280;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .header-title {
            font-size: 16pt;
            font-weight: bold;
            color: #111827;
            margin-top: 12px;
            letter-spacing: 1px;
        }
        .header-title span {
            color: #0891b2;
        }
        .header-line {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #0891b2, #0d9488);
            margin: 12px auto 0;
            border-radius: 2px;
        }

        /* Fields */
        .fields {
            margin-top: 25px;
        }
        .field-row {
            margin-bottom: 20px;
        }
        .field-row-inline {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .field-cell {
            display: table-cell;
            width: 50%;
            padding-right: 15px;
        }
        .field-cell:last-child {
            padding-right: 0;
            padding-left: 15px;
        }
        .field-label {
            font-size: 8pt;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .field-value {
            font-size: 11pt;
            font-weight: 600;
            color: #111827;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }

        /* Attestation */
        .attestation {
            margin-top: 35px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
        }
        .attestation-label {
            font-size: 8pt;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .attestation-text {
            font-size: 9pt;
            color: #6b7280;
            font-style: italic;
            line-height: 1.7;
        }

        /* Signature */
        .signature-block {
            margin-top: 30px;
            padding: 20px;
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
        }
        .signature-label {
            font-size: 9pt;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .signature-sublabel {
            font-size: 8pt;
            color: #9ca3af;
            margin-top: 2px;
        }

        /* Footer */
        .footer {
            margin-top: 25px;
            padding: 12px 16px;
            background: #f3f4f6;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .footer-hash {
            font-size: 7.5pt;
            color: #9ca3af;
            font-family: 'DejaVu Sans Mono', monospace;
            word-break: break-all;
            line-height: 1.6;
        }
        .footer-hash strong {
            color: #6b7280;
        }

        /* Metadata */
        .metadata {
            margin-top: 20px;
            text-align: center;
            font-size: 8pt;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="page">
        {{-- Document header --}}
        <div class="header">
            <p class="header-subtitle">Republic of the Philippines</p>
            <p class="header-subtitle" style="letter-spacing: 1px;">Civil Service Commission &middot; Quezon City</p>
            <p class="header-title">PERSONAL <span>DATA SHEET</span></p>
            <div class="header-line"></div>
        </div>

        {{-- Data fields --}}
        <div class="fields">
            <div class="field-row-inline">
                <div class="field-cell">
                    <p class="field-label">Full Name</p>
                    <p class="field-value">{{ $form->full_name }}</p>
                </div>
                <div class="field-cell">
                    <p class="field-label">Age</p>
                    <p class="field-value">{{ $form->age }}</p>
                </div>
            </div>

            <div class="field-row">
                <p class="field-label">Address</p>
                <p class="field-value">{{ $form->address }}</p>
            </div>

            <div class="field-row">
                <p class="field-label">Email Address</p>
                <p class="field-value">{{ $form->email_address }}</p>
            </div>
        </div>

        {{-- Attestation --}}
        <div class="attestation">
            <p class="attestation-label">Attestation</p>
            <p class="attestation-text">
                I hereby certify that the answers given above are true and correct to the best of my knowledge and belief.
                I understand that any falsification of information shall be subject to the applicable provisions of law.
            </p>
        </div>

        {{-- Signature --}}
        <div class="signature-block">
            <p class="signature-label">Awaiting Digital Signature</p>
            <p class="signature-sublabel">District Officer's PKI Certificate</p>
        </div>

        {{-- Hash footer --}}
        <div class="footer">
            <p class="footer-hash">
                <strong>SHA-256:</strong> {{ hash('sha256', json_encode($form->toArray())) }}
            </p>
        </div>

        {{-- Document metadata --}}
        <div class="metadata">
            Document ID: PDS-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
            &middot; Generated: {{ now()->format('M d, Y \\a\\t g:i A') }}
            &middot; E-Patunay Cryptographic Assurance Governance System
        </div>
    </div>
</body>
</html>
