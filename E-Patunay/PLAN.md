# E-Patunay Feasibility Assessment & Development Plan

## Context
Evaluating the feasibility of E-Patunay — a Cryptographic-Assurance Governance System for the Barangay Community Relations Department (BCRD), proposed as a BSIT Cybersecurity capstone by a 4-person team (Quadsec).

---

## Team Context
- **Timeline:** 3-4 months until defense
- **Team size:** 4 members (BSIT Cybersecurity)
- **Stack (finalized):** Laravel (PHP) + Vue.js + PostgreSQL (Updated)
- **Cloud:** Azure Student credits ($100)
- **Experience:** Mostly new to PKI, Keycloak, and Docker

---

## Overall Verdict: FEASIBLE — BUT ONLY WITH AGGRESSIVE SCOPE REDUCTION

The core idea is sound and the tech choices are appropriate. However, **3-4 months with a team new to PKI/Keycloak/Docker is extremely tight for the full 7-phase plan.** The learning curve alone for EJBCA, Keycloak, and Docker will consume 3-5 weeks. Without scope cuts, there is a high risk of an incomplete or superficial deliverable at defense.

**The good news:** A well-scoped MVP is absolutely achievable and still makes a strong thesis.

---

## Tech Stack Assessment

| Component | Choice | Verdict |
|-----------|--------|---------|
| Backend Framework | Laravel (PHP) | (updated).
| Frontend Framework | Vue.js | (Updated).
| PDF Generation | laravel-dompdf | (Updated).
| PDF Signing | TCPDF | (Updated).
| Database | PostgreSQL | **Excellent.** Perfect for audit trails, JSONB support, mature ecosystem. |
| PKI | EJBCA Community Edition | **High risk.** Steep learning curve, complex configuration. See concerns below. |
| IAM | Keycloak | **Good.** Well-documented, Docker-ready, supports MFA/RBAC out of the box. |
| Storage | Azure Blob Storage | **Good but costly.** Student credits may cover it. Lifecycle policies are straightforward. |
| Containers | Docker Compose | **Good.** Standard and appropriate. |

---

## Feature-by-Feature Feasibility

### Phase 1: Environment Setup — FEASIBLE
- Docker Compose, CI/CD, Azure provisioning are all standard tasks.
- Allocate ~1-2 weeks. This is foundational and should not be rushed.

### Phase 2: Keycloak IAM + RBAC — FEASIBLE
- Keycloak handles most of this out-of-the-box (realms, roles, MFA, SMTP).
- JWT validation is well-documented.
- **Risk:** District-level data isolation at the DB level adds complexity. Consider Keycloak attributes + application-layer filtering instead of DB-level row security.
- Allocate ~2-3 weeks.

### Phase 3: Document Lifecycle + PKI Signing — HIGH RISK
This is the most technically challenging phase:
- **PDF malware scanning:** Feasible with ClamAV (Docker container).
- **PAdES-LTV signing:** This is **hard**. Libraries exist (e.g., `iText` for Java, `node-signpdf` for Node) but PAdES-LTV with OCSP stapling + CRL embedding + TSA timestamps is advanced PKI work.
- **EJBCA setup:** Root CA + Sub-CA hierarchy, certificate issuance, OCSP responder — EJBCA Community Edition works but documentation is sparse and configuration is XML-heavy.
- **Alternative:** Consider simplifying to basic PKCS#7/CMS signatures or using a simpler PKI tool like `step-ca` (Smallstep) instead of EJBCA.
- Allocate ~4-6 weeks minimum.

### Phase 4: Cryptographic Audit Ledger — FEASIBLE BUT COMPLEX
- Append-only table with hash chaining is doable in PostgreSQL (triggers + constraints).
- **Daily Merkle Tree consolidation** adds significant complexity. This requires custom implementation — no off-the-shelf library handles this for PostgreSQL.
- **Simplification option:** Hash chain alone (without Merkle trees) already provides strong tamper evidence and may suffice for thesis scope.
- Allocate ~2-3 weeks.

### Phase 5: Tiered Storage + Encryption — FEASIBLE
- Azure Blob lifecycle policies are declarative (JSON config).
- AES-256 + Key Vault integration is well-documented.
- Key rotation is built into Azure Key Vault.
- Allocate ~1-2 weeks.

### Phase 6: Verification API + Analytics — FEASIBLE BUT BROAD
- REST API for external verification is straightforward.
- **Analytics dashboard** with Chart.js/Recharts is feasible but time-consuming to polish.
- **Risk:** Building both an external agency portal AND a full analytics dashboard doubles the frontend work.
- **Simplification:** Consider the analytics dashboard as a "nice-to-have" stretch goal.
- Allocate ~3-4 weeks.

### Phase 7: Testing + Pilot — FEASIBLE BUT TIME-INTENSIVE
- Using **6 different security tools** (Hydra, SQLMap, ZAP, Nikto, JMeter, Burp Suite) is ambitious but aligns with BSIT Cybersecurity program expectations.
- UAT with real BCRD staff requires coordination and scheduling lead time.
- Allocate ~3-4 weeks.

---

## Key Concerns

### 1. SCOPE IS THE #1 RISK
Conservatively, this project requires **16-24 weeks of focused development** for a 4-person team. With only ~14 weeks available, the timeline is very tight.

### 2. EJBCA + PAdES-LTV IS THE HARDEST PART
Full PKI with Long-Term Validation signing is enterprise-grade work. Many professional teams struggle with this. Consider:
- Using **Smallstep `step-ca`** instead of EJBCA (simpler, better docs, Go-based)
- Starting with basic digital signatures and upgrading to PAdES-LTV only if time permits

### 3. AZURE STUDENT CREDITS ($100) ARE LIMITED
$100 covers basic Blob Storage and Key Vault for a few months, but be careful with:
- VM hosting (use free-tier App Service or deploy locally for demo)
- Key Vault operations (charged per operation — can add up)
- **Tip:** Use MinIO locally for development, Azure only for staging/demo.

### 4. LEARNING CURVE IS THE HIDDEN COST
Being new to PKI, Keycloak, AND Docker means ~3-5 weeks will be spent just learning these tools before productive development begins. Budget this honestly in your Gantt chart.

### 5. REAL DEPLOYMENT DEPENDENCY
Pilot deployment at District 2 with actual BCRD staff requires:
- MoA (Memorandum of Agreement) signed and in place
- Staff availability for UAT
- Network/infrastructure at the deployment site
- These are **external dependencies** outside your control.

---

## Recommendations

### Must-Do (MVP for thesis defense)
1. Keycloak IAM with RBAC + MFA (Phase 2)
2. Document submission + review workflow (Phase 3, simplified)
3. Basic digital signing (CMS/PKCS#7, not full PAdES-LTV)
4. Append-only audit log with hash chain (Phase 4, no Merkle trees)
5. Azure Blob storage with basic lifecycle (Phase 5)
6. Verification API (Phase 6, simplified)
7. STRIDE security testing (Phase 7)

### Should-Do (if time permits)
- PAdES-LTV upgrade
- Merkle Tree consolidation
- Analytics dashboard
- Full external agency portal

### Nice-to-Have (stretch goals)
- Predictive resource allocation
- Compliance Maturity Score
- Automated credential term revocation

---

## Realistic 14-Week Timeline (3.5 months)

| Week | Focus | Notes |
|------|-------|-------|
| 1-2 | Docker + Keycloak learning, environment setup | All 4 members learn Docker. Get Keycloak running. |
| 3-4 | Keycloak IAM: realm, roles, MFA, JWT | 2 members on Keycloak, 2 on Spring Boot scaffold + Next.js pages |
| 5-7 | Core document workflow: submit, review, approve | Full-stack work. PDF upload, status tracking, approval flow. |
| 8-9 | Digital signing (start simple, CMS/PKCS#7) + audit log | 2 on signing (learn EJBCA or step-ca), 2 on hash-chain audit table |
| 10-11 | Azure Blob storage + Verification API | Lifecycle policies, basic external verification endpoint |
| 12 | Security testing (STRIDE) | Split 6 tools across 4 members |
| 13 | UAT, bug fixes, polish | Pilot with BCRD if MoA is ready; otherwise simulate |
| 14 | Documentation, defense prep | Chapter 4 findings, slides, demo rehearsal |

**Key tradeoffs in this timeline:**
- Merkle trees are cut (hash chain alone is defensible)
- Analytics dashboard is cut (show SQL queries + basic charts in defense)
- PAdES-LTV is downgraded to basic CMS signing (upgrade if time permits)
- External agency portal is a single-page verification form, not a full portal

---

## Final Take

**Is E-Patunay feasible? Yes** — the concept is well-researched, the tech stack is appropriate, and the team structure maps well to the phases. The Philippine legal compliance angle (RA 12254, RA 10173, RA 9470) is a strong thesis differentiator.

**The risk is not feasibility — it's scope.** The current plan describes what a 6-8 person team would build over 6+ months. For a 4-person team with 3-4 months and a learning curve, the key to success is **ruthless prioritization**: nail the core workflow (submit > review > sign > store > verify) with solid security, and treat everything else as stretch goals.

Your thesis panel will be more impressed by a **working, secure, well-tested core system** than a half-finished feature-complete one.
